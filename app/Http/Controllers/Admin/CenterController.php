<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Center\CenterRequest;
use App\Imports\CenterImport;
use App\Models\Center;
use App\Models\Time;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

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
        // $time = Time::all();
        $users = User::all();
        return view('dashboard.centers.edit',['data'=>$data,'users'=>$users]);
    }


    public function uploadCenters(Request $request)
    {
        $request->validate(['file'=>'required|file|mimes:xlsx,csv']);
        try {
            if($request->hasFile('file')) {
                Excel::import(new CenterImport, request()->file('file'));
                return redirect()->back()->with('success','Data Added');
            } else {
                return redirect()->back()->with('error','Incorrect Data Type');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function data()
    {
        $data = Center::with('user')->latest();
        return DataTables::of($data)
        ->addColumn('action',function($data){
            return view('dashboard.centers.action',['type'=>'action','data'=>$data]);
        })
        ->make(true);
    }



    public function store(CenterRequest $request)
    {
        $data = $request->validated();
        try{
            DB::beginTransaction();
            Center::create(
                array_merge($data));
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
        $center->update($data);
        DB::commit();
        return redirect()->back()->with('success','Data Updated Successfuly');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error','Error Accure');
        }
    }

    public function delete($id)
    {
        $data = Center::findOrFail($id);
        $data->delete();
        return response()->json(['status'=>true]);
        // return redirect()->back()->with('success','Data Deleted Successfuly');
    }
}
