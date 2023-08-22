<?php
namespace App\Http\Controllers\Inspector;
use App\Http\Controllers\Controller;
use App\Models\ExamTime;
use App\Models\ObserveActivity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExamProfileController extends Controller
{
 
    public function index()
    {
        return view('website.dashboard.exam_profile.index');
    }

    public function data()
    {
        $data = ObserveActivity::query()->with('examTime')->where('observe_id',auth('observe')->user()->id)->latest();
        return DataTables::of($data)
        // ->addColumn('action',function($data){
        //     return view('website.dashboard.exam_profile.action',['type'=>'action','data'=>$data]);
        // })
        ->addColumn('center',function($data){
            return $data->examTime->center->name;
        })
        ->addColumn('shift',function($data){
            return 'Shift '. $data->examTime->shift;
        })
        ->addColumn('date',function($data){
            return $data->examTime->exam->date;
        })
        ->editColumn('is_done',function($data){
            return $data->is_done == true ? 'Attended' : 'Not attended';
        })->make(true);     
    }

}
