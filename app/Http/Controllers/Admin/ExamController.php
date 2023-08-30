<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamValidation;
use App\Models\Category;
use App\Models\Center;
use App\Models\Exam;
use App\Models\Observe;
use App\Models\ObserveActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ExamController extends Controller
{

    /**
     * View Functions
     */
    public function index(Request $request)
    {
        $data = ObserveActivity::where('is_come', 1)
            ->whereHas('exam_time', function ($q) {
                $q->whereHas('exam', function ($q) {
                    $q->where('id', 18);
                })->with(['exam' => function ($q) {
                    $q->where('id', 18);
                }]);
            })
            ->with(['exam_time' => function ($q) {
                $q->whereHas('exam', function ($q) {
                    $q->where('id', 18);
                })->with(['exam' => function ($q) {
                    $q->where('id', 18);
                }]);
            }])->get();

        $exam = Exam::select('price')->where('id', 18)->first();
        // return $data->count() * $exam->price;
        try {
            return view('dashboard.exam.index');
        } catch (\Exception $ex) {
            return view('errors.500');
        }
    }

    public function data(Request $request)
    {
        $data = Exam::query()->filter($request->all())->latest();
        return DataTables::of($data)
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
                $current_date = Carbon::today();
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
            })
            ->addColumn('centers', function ($data) {
                return view('dashboard.exam.action', ['exam' => $data, 'type' => 'centers']);
            })
            ->addColumn('total_price', function ($data) {
                $active = ObserveActivity::where('is_come', 1)
                    ->whereHas('exam_time', function ($q)  use ($data) {
                        $q->whereHas('exam', function ($q)  use ($data) {
                            $q->where('id', $data->id);
                        })->with(['exam' => function ($q) use ($data) {
                            $q->where('id', $data->id);
                        }]);
                    })
                    ->with(['exam_time' => function ($q)  use ($data) {
                        $q->whereHas('exam', function ($q)  use ($data) {
                            $q->where('id', $data->id);
                        })->with(['exam' => function ($q)  use ($data) {
                            $q->where('id', $data->id);
                        }]);
                    }])->count();
                return $active * $data->price . ' AED';
            })
            ->addColumn('attendance', function ($data) {
                return view('dashboard.exam.action', ['exam' => $data, 'type' => 'attendance']);
            })
            ->make(true);
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
            $centers =  Center::all();
            $selectedCenter  = explode(',', $exam->centers);
            if (!$exam) {
                return view('errors.404');
            }
            return view('dashboard.exam.edit', compact('exam', 'selectedCenter', 'centers', 'categories'));
        } catch (\Exception $ex) {
            return view('errors.500');
        }
    }

    /**
     * Centers join in exam
     */
    public function centers_show(Request $request)
    {
        $exam = Exam::find($request->exam_id);
        // return $exam_id;
        return view('dashboard.exam.centers', compact('exam'));
    }
    public function centers_data($exam_id)
    {
        $data = Center::query()
            ->whereHas('exam_time', function ($q) use ($exam_id) {
                $q->where('exam_id', $exam_id);
            })
            ->with(['exam_time' => function ($q) use ($exam_id) {
                $q->where('exam_id', $exam_id);
            }])->with('user')
            ->latest();

        return DataTables::of($data)
            ->addColumn('price', function ($data) {
                return $data;
            })
            ->addColumn('action', function ($data) {
                return view('dashboard.exam.action', ['type' => 'data']);
            })
            ->addColumn('shift', function ($data) {
                $shift = $data->exam_time;
                return view('dashboard.exam.action', ['data' => $shift, 'type' => 'shift']);
            })
            ->addColumn('Invigilator', function ($data) {
                $Invigilator = $data->exam_time;
                return view('dashboard.exam.action', ['data' => $Invigilator, 'type' => 'Invigilator']);
            })
            ->make(true);
    }

    /**
     * attendance join in exam
     */
    public function attendance_show(Request $request)
    {
        $exam = Exam::find($request->exam_id);
        $centers = Center::all();
        return view('dashboard.exam.attendance', compact('exam', 'centers'));
    }
    public function attendance_data($exam_id, Request $request)
    {
        $data = ObserveActivity::filter($request->all())->whereHas('exam_time', function ($q) use ($request) {
            $q->filter($request->all())->where('exam_id', $request->exam_id);
        })
            ->with(['exam_time' => function ($q) use ($request) {
                $q->where('exam_id', $request->exam_id)->with('center');
            }])
            ->with(['observes'])->latest();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('dashboard.exam.action', ['type' => 'data']);
            })
            ->addColumn('attend', function ($data) {
                return view('dashboard.exam.action', ['data' => $data, 'type' => 'attend']);
            })
            ->make(true);
    }

    /**
     * Functionality Functions
     */
    public function store(ExamValidation $request)
    {
        $data =  $request->validated();

        try {
            if ($request->center_id) {
                $centers =  implode(',', $request->center_id);
                Exam::create(array_merge($data, ['centers' => $centers]));
            } else {
                Exam::create($data);
            }

            return redirect()->back()->with(['success' => 'Data saved successfully!']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'There are error , Try again later...']);
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
                'show_date' => 'required|date',
                'center_id' => 'array'
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
                if ($request->center_id) {
                    $centers =  implode(',', $request->center_id);
                    // Exam::create(array_merge($data,['centers'=>$centers]));
                    $exam->update(array_merge($request->all(), ['centers' => $centers]));
                } else {
                    $exam->update($request->except('_token,center_id'));
                }
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

    public function payment($exam_id)
    {
        try {
            $exam = Exam::findOrFail($exam_id);
            if (!$exam) {
                return view('errors.500');
            }
            if ($exam->paid == 0) {
                $current_date = Carbon::today();
                $date = Carbon::parse($exam->date)->format('Y-m-d');
                $days = Carbon::parse($date)->diffInDays($current_date);
                $diff = Carbon::parse($date)->diff($current_date)->invert;

                if ($days != 0 && $diff == 0) {
                    $status = -1;
                } else if ($days == 0 && $diff == 0) {
                    $status = 0;
                } else {
                    $status = 1;
                }
                if ($status != 1) {
                    $exam = Exam::with(['ObserveActivity' => function ($q) {
                        $q->with('observes');
                    }])->get();
                    DB::beginTransaction();
                    $exam = Exam::where('id', $exam_id)
                        ->with(['ObserveActivity' => function ($q) {
                            $q->with(['observes' => function ($q) {
                                $q->select('id', 'price');
                            }]);
                        }])->first();

                    if ($exam) {
                        $observeActivity = collect($exam->ObserveActivity);
                        foreach ($observeActivity as $observe) {
                            $observe->observes->update(['price' => $observe->observes->price - $exam->price]);
                        }
                    }
                    $exam->update(['paid' => 1]);
                    DB::commit();
                    return response()->json(['success' => "Data Updated successfully!"]);
                } else {
                    DB::rollBack();
                    return response()->json(['error' => "You can only pay after completing the exam"]);
                }
            } else {
                return response()->json(['error' => "Already Paid"]);
            }
        } catch (\Exception $ex) {
            return view('errors.500');
        }
    }
}
