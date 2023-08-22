<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamTime;
use App\Models\ObserveActivity;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                if(in_array($center,explode(',',$exam->centers)))
                {
                    array_push($list,$exam->id);
                }
           }
        }   
        // Check if Applyed Before //
        $activity  = ObserveActivity::where('observe_id',auth('observe')->user()->id)->pluck('exam_time_id');
        if(count($activity) > 0)
        {
            $data->whereNotIn('id',json_decode(json_encode ( $activity ) , true));
        }
        
        $allExams  = Exam::where('type','public')->where('expire',0)->pluck('id');

        $all =  array_merge($list,json_decode(json_encode ( $allExams ) , true));
        $data = $data->with('center')->with('exam')->where('is_done', 0)
          ->whereIn('exam_id', $all)
          ->whereHas('exam', function($q) {
            $q->whereDate('date','>',Carbon::now())->whereDate('show_date','<=',Carbon::now());
        })
          ->latest();
        return DataTables::of($data)->addColumn('action',function($data){
            return view('website.dashboard.exams.action',['type'=>'action','data'=>$data]);
        })
        ->editColumn('shift',function($data){
            return 'Shift'.$data->shift;
        })->make(true);   
  
    }

    public function apply(Request $request)
    {
        try{
            $examTime = ExamTime::find($request->id);
            $numOfActivity= ObserveActivity::where('exam_time_id',$request->id)->count();
            if($examTime->num_of_observe > $numOfActivity)
            {
                $data =  ObserveActivity::create([
                    'observe_id'=>auth('observe')->user()->id,
                    'exam_time_id'=>$request->id,
                ]);
                return response()->json(['status'=>true]);
            }else{
                $examTime->update(['is_done'=>true]);
                return response()->json(['status'=>false,'message'=>'Exam Completed']);
            }
        }catch(Exception $e)
        {
            return response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }

}
