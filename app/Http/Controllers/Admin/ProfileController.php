<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ProfileEmail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function sendEmail()
    {
        try{
            $code =  rand(10000,99999);
            Mail::to(auth()->user()->email)->send(new ProfileEmail($code));
            $user = User::findOrFail(auth()->user()->id);  
            $user->update(['code'=>$code]); 
            return view('dashboard.profile.code');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


    public function checkCode(Request $request)
    {
        $request->validate(['code'=>'required']);
        if($request->code == auth()->user()->code )
        {
            return view('dashboard.profile.change');
        }else{
            return redirect()->back()->with('error','Invaild Code Another Code Resend To Your Email');
        }
    }

    // update profile




    public function changePassword(Request $request)
    {
        $request->validate([
            'password'=>'required',
            'password_confirmation'=>'required',
            'old_password'=>'required'
        ]);
        if($request->password != $request->password_confirmation)
        {
            return redirect()->back()->with('error','Password Not Same');
        }
        if(Hash::check($request->old_password,auth()->user()->password))
        {
            $admin = User::find(auth()->user()->id);
            $admin->update([
                'password'=>Hash::make($request->password)
            ]);
            return redirect()->back()->with('success','Password Change');
       
        }else
        {
            return redirect()->back()->with('error','Invaild Password');
     
        }
    }
    public function index()
    {
        return view('dashboard.profile.index');
    }
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.auth()->user()->id,
            'phone'=>'required|unique:users,phone,'.auth()->user()->id,
        ]);
        
        if(User::findOrFail(auth()->user()->id)->update($request->all()))
        {
            return redirect()->back()->with('success','Profile Updated');
        }else{
            return redirect()->back()->with('Error','Error Accure');
        }
        
        
    }

}
