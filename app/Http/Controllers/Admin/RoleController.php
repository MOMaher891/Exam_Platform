<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['role:superadmin']);     
    }

    
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.roles.index',compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('dashboard.roles.edit',compact('role'));
    }
    
}
