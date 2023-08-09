<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['role:superadmin']);
    }


    public function index()
    {
        return view('dashboard.roles.index');
    }

    public function data()
    {
        $data = Role::query()->latest();
        return DataTables::of($data)->addColumn('action',function($data){
            return view('dashboard.roles.action',['role'=>$data,'type'=>'action']);
        })->make(true);
    }

    public function create()
    {
        return view('dashboard.roles.create');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('dashboard.roles.edit',compact('role'));
    }

    public function store(Request $request)
    {
        $request->validate(['display_name'=>'required']);
        $roleName = Str::slug($request->display_name);
        Role::create(array_merge($request->all(),['name'=>$roleName]));
        return redirect()->back()->with('success','New Role Added');
    }

    public function update(Request $request,$id)
    {
        $request->validate(['display_name'=>'required']);
        $data = Role::findOrFail($id);
        $data->update($request->all());
        return redirect()->back()->with('success','Role Updated');
    }
}
