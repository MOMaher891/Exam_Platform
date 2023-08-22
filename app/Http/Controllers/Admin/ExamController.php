<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamValidation;
use App\Models\Category;
use App\Models\Center;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:superadmin']);
    }
    /**
     * View Functions
     */
    public function index()
    {
        try {
            return view('dashboard.exam.index');
        } catch (\Exception $ex) {
            return view('errors.500');
        }
    }

    public function data()
    {

        $data = Exam::query()->latest();
        return DataTables::of($data)
            ->addColumn('category_id', function ($data) {
                return $data->category->name;
            })
            ->addColumn('price', function ($data) {
                return $data->price . ' $';
            })
            ->editColumn('type', function ($data) {
                $centers = '';
                if ($data->type == 'private') {
                    $centers = Center::whereIn('id', explode(',', $data->centers))->get();
                }

                return view('dashboard.exam.action', ['data' => $data, 'centers' => $centers, 'type' => 'type']);
            })
            ->addColumn('status', function ($data) {
                $current_date = Carbon::today()->addDay();
                $date = Carbon::parse($data->date)->format('Y-m-d');
                $days = Carbon::parse($date)->diffInDays($current_date);
                $diff = Carbon::parse($date)->diff($current_date)->invert;

                if ($days != 0 && $diff == 0) {
                    $data->update(['expire' => 1]);
                    $status = -1;
                } else if ($days == 0 && $diff == 0) {
                    $status = 0;
                } else {
                    $status = 1;
                }

                return view('dashboard.exam.action', ['status' => $status, 'type' => 'status']);
            })->addColumn('action', function ($data) {
                return view('dashboard.exam.action', ['exam' => $data, 'type' => 'action']);
            })->make(true);
    }

    public function create()
    {
        try {
            $centers =  Center::all();
            $categories = Category::all(); // Get All Categories
            return view('dashboard.exam.create', compact('categories', 'centers'));
        } catch (\Exception $ex) {
            return view('errors.500');
        }
    }

    public function edit($exam_id)
    {
        try {
            $categories = Category::get();
            $exam = Exam::find($exam_id);
            if (!$exam) {
                return view('errors.404');
            }
            return view('dashboard.exam.edit', compact('exam', 'categories'));
        } catch (\Exception $ex) {
            return view('errors.500');
        }
    }

    /**
     * Functionality Functions
     */
    public function store(ExamValidation $request)
    {
        $data =  $request->validated();

        try{
            if($request->center_id)
            {
                $centers =  implode(',',$request->center_id);
                Exam::create(array_merge($data,['centers'=>$centers]));
            }else{
                Exam::create($data);
            }

            return redirect()->back()->with(['success'=>'Data saved successfully!']);

        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'There are error , Try again later...']);
        }
    }

    public function update(Request $request)
    {
        try {
            /**
             * Validation
             */
            $validator = Validator::make($request->all(), [
                'price' => 'required|numeric|gt:0',
                'date' => 'required|date',
                'name' => [
                    'required',
                    'string',
                    Rule::unique('exams')->ignore($request->id), //Check Name In exam table
                ],
                'category_id' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            //Check User exist or not
            $exam = Exam::findOrFail($request->id);
            if (!$exam) {
                return view('errors.404');
            } else {
                $exam->update($request->except('_token'));
                return redirect()->back()->with(['success' => "Data saved successfully!"]);
            }
        } catch (\Exception $ex) {
            return view('errors.500');
        }
    }

    public function delete($exam_id)
    {
        try {
            $exam = Exam::findOrFail($exam_id);
            if (!$exam) {
                return view('errors.500');
            }

            $exam->delete();
            return response()->json(['success' => "Data deleted successfully!"]);
        } catch (\Exception $ex) {
            return view('errors.500');
        }
    }
}
