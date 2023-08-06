<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function loginView()
    {
        return view('dashboard.login');
    }

    public function login(Request $request)
    {
        $request->validate(['email'=>'required|email','password'=>'required']);

        if(! Auth::attempt($request->only('email','password')))
        {
            return redirect()->back()->with('error','Invaild Email and Password');
        }else{
            return redirect()->route('admin')->with('success','Welcome');
        }
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login.view');
    }
}
