<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use App\Mail\ProfileEmail;
use App\Models\Center;
use App\Models\Observe;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    //
    public function verify()
    {
        return view('website.dashboard.profile.verifiy');
    }
    public function sendEmail()
    {
        try {
            $code = rand(10000, 99999);
            Mail::to(auth('observe')->user()->email)->send(new ProfileEmail($code));
            $user = Observe::findOrFail(auth('observe')->user()->id);
            $user->update(['code' => $code]);
            return view('website.dashboard.profile.check');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function checkCode(Request $request)
    {
        $request->validate(['code' => 'required']);
        if ($request->code == auth('observe')->user()->code) {
            return view('website.dashboard.profile.change');
        } else {
            $code = rand(10000, 99999);
            Mail::to(auth('observe')->user()->email)->send(new ProfileEmail($code));
            $user = Observe::findOrFail(auth('observe')->user()->id);
            $user->update(['code' => $code]);
            return redirect()->back()->with('error', 'Invaild Code Another Code Resend To Your Email');
        }
    }



    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_confirmation' => 'required',
            'old_password' => 'required'
        ]);
        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->with('error', 'Password Not Same');
        }
        if (Hash::check($request->old_password, auth('observe')->user()->password)) {
            $admin = Observe::find(auth('observe')->user()->id);
            $admin->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back()->with('success', 'Password Change');
        } else {
            return redirect()->back()->with('error', 'Invaild Password');
        }
    }
    public function index()
    {
        $centers = Center::all();
        return view('website.dashboard.profile.index', compact('centers'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:observes,email,' . auth('observe')->user()->id,
            'phone' => 'required|unique:observes,phone,' . auth('observe')->user()->id,
            'image' => 'file'
        ]);
        $data = $request->all();

        if ($request->file('image')) {
            $image =  $this->uploadImage($request->file('image'), $this->personal);
            $data['img_personal'] = $image;
        }
        if (Observe::findOrFail(auth('observe')->user()->id)->update($data)) {
            return redirect()->back()->with('success', 'Profile Updated');
        } else {
            return redirect()->back()->with('Error', 'Error Accure');
        }
    }
}
