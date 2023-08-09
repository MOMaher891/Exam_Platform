<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Center\CenterRequest;
use App\Models\Center;
use App\Models\Time;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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
        return view('dashboard.centers.create',['data'=>$user,'times'=>$times]);
    }


    

    public function edit($id)
    {
        $data = Center::with('user')->findOrFail($id);
        $time = Time::all();
        return view('dashboard.centers.edit',['data'=>$data,'times'=>$time]);
    }

    public function data()
    {
        $data = Center::with('user')->latest();

        return DataTables::of($data)
        ->addColumn('action',function($data){
            return view('dashboard.centers.action',['type'=>'action','data'=>$data]);
        });
    }



    public function store(CenterRequest $request)
    {
        $data = $request->validated();
        try{
            DB::beginTransaction();
            Center::create(array_merge($data,['time_ids'=>implode(',',$request->time_ids)]));
            DB::commit();
            return redirect()->back()->with('success','Data Added Successfuly');

        }catch(Exception $e)

        {
            DB::rollBack();
            return redirect()->back()->with('error','Error Accure');
        }
    }

    public function update(CenterRequest $request,$id)
    {
        $data = $request->validated();
        $center = Center::findOrFail($id);
        try{
        DB::beginTransaction();
        $center->update(array_merge($data,['time_ids'=>implode(',',$request->time_ids)]));
        DB::commit();
        return redirect()->back()->with('success','Data Updated Successfuly');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error','Error Accure');
        }
    }

    public function delete(Request $request)
    {
        $data = Center::findOrFail($request->id);
        $data->delete();
        return redirect()->back()->with('success','Data Deleted Successfuly');
    }
}
