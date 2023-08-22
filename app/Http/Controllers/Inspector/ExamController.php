<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamTime;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExamController extends Controller
{
    //
    public function index()
    {    
        return view('website.dashboard.exams.index');
    }

    public function data()
    {
        $center  = auth('observe')->user()->center_id;
        $list = [];
        
        $data = ExamTime::query();
        if($center != null)
        {
           $private = Exam::where('type','private')->where('expire',0)->get();

           foreach($private as $exam)
           {
                if(in_array($center->id,explode(',',$exam->centers)))
                {
                    array_push($list,$exam);
                }
           }
        }   
        $allExams  = Exam::where('type','public')->where('expire',0)->pluck('id');

        $all =  array_merge($list,json_decode(json_encode ( $allExams ) , true));

        $data = $data->with('exam')->with('center')->where('is_done',0)->whereIn('exam_id',$all)->latest();

        return DataTables::of($data)->addColumn('action',function($data){
            return view('website.dashboard.exams.action',['type'=>'action','data'=>$data]);
        })->make(true);
    }


}
