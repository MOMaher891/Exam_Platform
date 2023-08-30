<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Center\CenterRequest;
use App\Imports\CenterImport;
use App\Models\Center;
use App\Models\ExamTime;
use App\Models\ObserveActivity;
use App\Models\Time;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class CenterController extends Controller
{
    //
    public function index()
    {

        return view('dashboard.centers.index');
    }

    public function create()
    {
        $times = Time::all();
        $user  = User::whereRoleIs('admin')->get();
        return view('dashboard.centers.create', ['data' => $user, 'times' => $times]);
    }




    public function edit($id)
    {
        $data = Center::with('user')->findOrFail($id);
        // $time = Time::all();
        $users = User::all();
        return view('dashboard.centers.edit', ['data' => $data, 'users' => $users]);
    }


    public function uploadCenters(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:xlsx,csv']);
        try {
            if ($request->hasFile('file')) {
                Excel::import(new CenterImport, request()->file('file'));
                return redirect()->back()->with('success', 'Data Added');
            } else {
                return redirect()->back()->with('error', 'Incorrect Data Type');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function data()
    {
        $data = Center::with('user')->latest();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('dashboard.centers.action', ['type' => 'action', 'data' => $data]);
            })
            ->make(true);
    }



    public function store(CenterRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            Center::create($data);
            DB::commit();
            return redirect()->back()->with('success', 'Data Added Successfuly');
        } catch (Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'Error Accure');
        }
    }

    public function update(CenterRequest $request, $id)
    {
        $data = $request->validated();
        $center = Center::findOrFail($id);
        try {
            DB::beginTransaction();
            $center->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Data Updated Successfuly');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Accure');
        }
    }

    public function delete($id)
    {
        $data = Center::findOrFail($id);
        $data->delete();
        return response()->json(['status' => true]);
        // return redirect()->back()->with('success','Data Deleted Successfuly');
    }

    /**
     * Exam for each center
     */
    public function exam_for_center_show(Request $request)
    {
        $center = Center::findOrFail($request->center_id);
        if (!$center) {
            return view('errors.404');
        } else {
            $data = ExamTime::where('center_id', $request->center_id)
                ->when($request->date_from && $request->date_to, function ($query) use ($request) {
                    $from = Carbon::parse($request->date_from);
                    $to = Carbon::parse($request->date_to);
                    $query->whereHas('exam', function ($q) use ($from, $to) {
                        $q->whereBetween('date', [$from, $to]);
                    })->with(['exam' => function ($q) use ($from, $to) {
                        $q->whereBetween('date', [$from, $to]);
                    }]);
                })->with('exam')
                ->get();
            // return $data;
            return view('dashboard.centers.exams', compact('center'));
        }
    }
    public function exam_for_center_data($center_id, Request $request)
    {
        try {

            $data = ExamTime::where('center_id', $request->center_id)
                ->when($request->date_from && $request->date_to, function ($query) use ($request) {
                    $from = Carbon::parse($request->date_from);
                    $to = Carbon::parse($request->date_to);
                    $query->whereHas('exam', function ($q) use ($from, $to) {
                        $q->whereBetween('date', [$from, $to]);
                    })->with(['exam' => function ($q) use ($from, $to) {
                        $q->whereBetween('date', [$from, $to]);
                    }]);
                })->with('exam')->latest();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('dashboard.centers.exam_action', ['type' => 'attendance', 'data' => $data]);
                })
                ->make(true);
        } catch (\Exception $ex) {
            return $ex;
        }
    }


    /**
     * Attendance for each exam in center
     */

    public function inspector_for_exam_show(Request $request)
    {
        $data = $request->exam_time_id;

        $exam = ExamTime::with('exam')->where('id', $request->exam_time_id)->first();
        // return $exam;
        return view('dashboard.centers.inspector', compact('data', 'exam'));
    }
    public function inspector_for_exam_data($exam_time_id)
    {
        $data = ObserveActivity::with(['observes', 'exam_time' => function ($q) {
            $q->with('exam');
        }])->where('exam_time_id', $exam_time_id)->latest();
        return DataTables::of($data)
            ->editColumn('is_done', function ($data) {
                return $data->is_come == true ? 'Attended' : 'Not attended';
            })
            ->make(true);
    }
}
