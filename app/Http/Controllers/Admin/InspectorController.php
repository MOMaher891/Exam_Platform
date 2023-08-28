<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ExamPlatFormMail;
use App\Models\Center;
use App\Models\ExamTime;
use App\Models\Observe;
use App\Models\ObserveActivity;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Support\Facades\Mail;
use App\Mail\accept_inspector;
use App\Models\Black_lists;
use App\Models\Exam;
use Exception;
use Illuminate\Support\Facades\DB;

class InspectorController extends Controller
{
    /**
     * View Functions
     */
    public function index()
    {
        return view('dashboard.inspector.index');
    }
    public function data(Request $request)
    {
        $user_id = Auth::user()->id;
        $center = Center::where('user_id', $user_id)->first();

        if (Auth::user()->hasRole('admin')) {

            $user_id = Auth::user()->id;
            $center = Center::where('user_id', $user_id)->first();
            $data = Observe::with(['observe_activities' => function ($q) use ($center) {
                $q->whereHas('exam_time', function ($q) use ($center) {
                    $q->where('center_id', $center->id);
                })->with(['exam_time' => function ($q) {
                    $q->with('center');
                }]);
            }])->whereHas('observe_activities', function ($q) use ($center) {
                $q->whereHas('exam_time', function ($q) use ($center) {
                    $q->where('center_id', $center->id);
                })->with(['exam_time']);
            })
                ->with(['black_list' => function ($q) use ($center) {
                    $q->where('center_id', $center->id);
                }])
                ->get();
            return $this->return_data($data);
        } else {
            
            $data = Observe::query()->with('center')->latest()->get();

            if($request->status)
            {
                $data = $data->where('status', $request->status);
            }       

            return $this->return_data($data);
        }
    }

    public function return_data($data)
    {
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('dashboard.inspector.action', ['inspector' => $data, 'type' => 'action']);
            })
            ->addColumn('show_profile', function ($data) {
                return view('dashboard.inspector.action', ['inspector' => $data, 'type' => 'show_profile']);
            })
            ->addColumn('block', function ($data) {
            })
            ->editColumn('status',function($data){
                return view('dashboard.inspector.action', ['inspector' => $data, 'type' => 'status']);

            })
            
            ->make(true);
    }


    public function show($inspector_id)
    {
        $inspector = Observe::findOrFail($inspector_id);
        if (!$inspector) return redirect()->back()->with(["error" => "Inspector not found"]);
        return view('dashboard.inspector.show', compact('inspector'));
    }

    public function exams()
    {
        return view('dashboard.inspector.exam');
    }
    public function exam_data()
    {
        $user_id = Auth::user()->id;
        $center = Center::where('user_id', $user_id)->first();
        $data = ExamTime::where('center_id', $center->id)->with(['exam'])->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('dashboard.inspector.exam_action', ['inspector' => $data, 'type' => 'action']);
            })
            ->addColumn('show_profile', function ($data) {
                return view('dashboard.inspector.exam_action', ['inspector' => $data, 'type' => 'show_profile']);
            })
            ->make(true);
    }
    public function exam_observe(Request $request)
    {
        $user_id = Auth::user()->id;
        $center = Center::where('user_id', $user_id)->first();

        $data = ExamTime::where('center_id', $center->id)->where('id', $request->exam_id)->with(['observeActivity' => function ($q) {
            $q->with('observes');
        }])->first();

        // return $data;
        return view('dashboard.inspector.exam_observe', compact('data'));
    }

    public function is_come($observe_id)
    {
        $observe_activitie = ObserveActivity::with('exam_time')->findOrFail($observe_id);
        $inspector = Observe::findOrFail($observe_activitie->observe_id);
        $exam = Exam::findOrFail($observe_activitie->exam_time->exam_id);
        // return $exam;
        try {
            DB::beginTransaction();
            $observe_activitie->update(['is_come' => 1]);
            $inspector->update(['price' => $inspector->price + $exam->price]);
            DB::commit();
            return redirect()->back()->with(['success' => 'تم تحضير المراقب']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'There are error occur']);
        }
    }



    /**************************
     * Block Inspector
     ***************************/
    public function block($inspector_id)
    {
        $inspector = Observe::findOrFail($inspector_id);

        $user_id = Auth::user()->id;
        $center = Center::where('user_id', $user_id)->first();

        $black_list = Black_lists::where('observe_id', $inspector->id)->where('center_id', $center->id)->first();
        // return $black_list;
        try {
            if (!$black_list) {
                Black_lists::create([
                    'observe_id' => $inspector->id,
                    'center_id' => $center->id,
                ]);
                return redirect()->back()->with(['success' => 'User blocked successfully']);
            } else {
                $black_list->delete();
                return redirect()->back()->with(['success' => 'User unblocked successfully']);
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'There are error occur']);
        }
    }

    /**************************
     * Accept or reject inspector
     ***************************/
    public function accept($inspector_id)
    {
        $inspector = Observe::findOrFail($inspector_id);
        if (!$inspector) {
            return response()->json(['error' => 'Inspector not found']);
        }
        try {
            $inspector->update(['status' => 'accept']);
            // $data = [
            //     'subject' => 'Exam Platform mail',
            //     'body' => 'Congratulation .
            //             Your data has been reviewed successfully, now you can log in'
            // ];
            $subject = 'Exam Platform mail';
            $body = 'Congratulation .
                        Your data has been reviewed successfully, now you can log in';



            Mail::to($inspector->email)->send(new ExamPlatFormMail($subject,$body));
            return redirect()->back()->with(['success' => 'Data saved successfully!']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'There are error occur']);
        }
    }


    public function reject(Request $request)
    {
        try{
            $inspector = Observe::findOrFail($request->id);
            // $data = [
            //     'subject' => 'Exam Platform mail',
            //     'body' => $request->reason
            // ];
            
            $subject = 'Exam Platform mail';
            $body = $request->reason;

            Mail::to($inspector->email)->send(new ExamPlatFormMail($subject,$body));
            if (!$inspector) {
                return response()->json(['error' => 'Inspector not found']);
            }
            $inspector->update(['status' => 'cancel']);
            return redirect()->back()->with(['success' => 'Data saved successfully!']);
       
            }catch(Exception $e)
            {
                return redirect()->back()->with(['error'=>$e->getMessage()]);
            }
        }

    public function delete($inspector_id)
    {

        $inspector = Observe::findOrFail($inspector_id);
        if (!$inspector) {
            return response()->json(['error' => 'Inspector not found']);
        }

        try {
            $attachments = [
                $this->personal . '/' . $inspector->img_personal,
                $this->passport . '/' . $inspector->img_passport,
                $this->national_id . '/' . $inspector->img_national,
                $this->national_id . '/' . $inspector->img_national_back,
                $this->certificate . '/' . $inspector->img_certificate,
                $this->certificate_good_conduct . '/' . $inspector->img_certificate_good_conduct
            ];
            foreach ($attachments as $img) {
                if (File::exists($img)) {
                    File::delete($img);
                }
                $inspector->delete();
            }
        } catch (\Exception $ex) {
        }
    }

    /**************************
     * Inspector in specific center
     ***************************/
    public function Inspector_in_center()
    {
        return view('dashboard.inspector.center_inspector');
    }
    public function Inspector_in_center_data()
    {
        $user_id = Auth::user()->id;
        $center = Center::where('user_id', $user_id)->first();
        $data = Observe::where('center_id', $center->id)->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('dashboard.inspector.action', ['inspector' => $data, 'type' => 'action']);
            })
            ->addColumn('show_profile', function ($data) {
                return view('dashboard.inspector.action', ['inspector' => $data, 'type' => 'show_profile']);
            })
            ->make(true);
    }
}
