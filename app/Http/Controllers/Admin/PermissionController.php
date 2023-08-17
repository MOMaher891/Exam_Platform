<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    public function index($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('dashboard.roles.permissions',compact('role','permissions'));
    }

    public function update(Request $request,$id)
    {
        $role = Role::findOrFail($id);
        if($request->permissions != null)
        {
            $role->syncPermissions($request->permissions);
        }else{
            $role->syncPermissions([]);
        }
        return redirect()->back()->with('success','Permission Updated');
    }
}
