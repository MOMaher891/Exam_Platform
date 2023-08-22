<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamTimeRequest;
use App\Models\Center;
use App\Models\Exam;
use App\Models\ExamCenter;
use App\Models\ExamTime;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ExamTimeController extends Controller
{
    //
    public function index()
    {

        return view('dashboard.exam_times.index');
    }

    public function data()
    {
        $privateList = [];
        $center =  Center::where('user_id', auth()->user()->id)->first();
        $exist = ExamTime::where('center_id', $center->id)->pluck('exam_id')->unique(); // id exams times
        $privateExams = Exam::where('type', 'private')->where('expire', 0)->get();

        foreach ($privateExams as $exam) {
            if (in_array($center->id, explode(',', $exam->centers))) {
                if (in_array($exam->id, json_decode(json_encode($exist), true)) == false) {
                    array_push($privateList, $exam->id);
                }
            }
        }
        $allPublicExams = Exam::where('type', 'public')->whereNotIn('id', $exist)->where('expire', 0)->pluck('id');

        $all =  array_merge($privateList, json_decode(json_encode($allPublicExams), true));


        $data = Exam::query()->with('category')->whereIn('id', $all)->latest();
        return DataTables::of($data)
        ->addColumn('action',function($data){
            return view('dashboard.exam_times.action',['data'=>$data,'type'=>'action']);
        })
        
        ->make(true);

    }
    public function create($id)
    {
        $data = Exam::findOrFail($id);
        $centers = Center::where('user_id', auth()->user()->id)->get();
        $timeTo = Carbon::parse($data->time)->addHour($data->num_of_hours)->format('H:i');
        return view('dashboard.exam_times.create', ['centers' => $centers, 'data' => $data, 'time_to' => $timeTo, 'time_from' => Carbon::parse($data->time)->format('H:i')]);
    }

    public function store(ExamTimeRequest $request, $id)
    {
        $data = $request->validated();
        try {
            // if(count($data['from']) == count($data['to']) && count($data['from']) == count($data['num_of_observe']))
            // {
                DB::beginTransaction();
                foreach($data['num_of_observe'] as $index => $d)
                {
                    ExamTime::create(array_merge($data,[
                    'exam_id'=>$id,
                    'num_of_observe'=>$d,
                    'shift'=>$index+1
                ]));
            }
            DB::commit();
            return redirect()->route('admin.exam_times.index')->with('success', 'You Have Applyed to this Exam');
            // }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
