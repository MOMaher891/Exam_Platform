<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use App\Http\Requests\InspectorValidation;
use App\Mail\ProfileEmail;
use App\Models\Center;
use App\Models\Observe;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * View Functions
     */
    public function registerView()
    {
        $centers = Center::all();
        return view('website.register', compact('centers'));
    }
    public function loginView()
    {
        return view('website.login');
    }

    /**************************
     * Authentication functions
     ***************************/

    public function register(InspectorValidation $request)
    {

        $request->validated();

        try {
            $data = $request->except('_token');
            $data['password'] = Hash::make($data['password']); // Hash the password

            try {
                /***********************
                 * Save Images
                 ************************/
                if ($request->file('img_personal')) {
                    $data['img_personal'] = $this->uploadImage($request->file('img_personal'), $this->personal);
                }
                if ($request->file('img_national')) {
                    $data['img_national'] = $this->uploadImage($request->file('img_national'), $this->national);
                }
                if ($request->file('img_national_back')) {
                    $data['img_national_back'] = $this->uploadImage($request->file('img_national_back'), $this->national_back);
                }
                if ($request->file('img_passport')) {
                    $data['img_passport'] = $this->uploadImage($request->file('img_passport'), $this->passport);
                }
                if ($request->file('img_certificate')) {
                    $data['img_certificate'] = $this->uploadImage($request->file('img_certificate'), $this->certificate);
                }
                if ($request->file('img_certificate_good_conduct')) {
                    $data['img_certificate_good_conduct'] = $this->uploadImage($request->file('img_certificate_good_conduct'), $this->certificate_good_conduct);
                }
            } catch (\Exception $ex) {
                return redirect()->back()->with(['error' => "There are error occur"]);
            }

            DB::beginTransaction();
            $user =  Observe::create($data);
            // Attach User With Role Inspector //
            // $user->attachRole('inspector');
            DB::commit();
            return redirect()->back()->with(['success' => "Your application will be reviewd and we will be responded to as soon as possible"]);
        } catch (\Exception $ex) {
            DB::rollBack();
            // return $ex;
            return redirect()->back()->with(['error' => "There are error occur"]);
        }
    }

    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);

        if (!Auth::guard('observe')->attempt($request->only('email', 'password'))) {
            return redirect()->back()->with('error', 'Invaild Email and Password');
            // return response()->json(['Error' => "Error in email or password"]);
        } else {
            return redirect()->route('inspector.home')->with('success', 'Welcome');
        }
        // return $request;
    }

    public function verify()
    {
        return view('website.verify');
    }
    public function sendEmail(Request $request)
    {
        try {
            $user = Observe::where('email',$request->email)->first();
            if($user)
            {
                $code = rand(10000, 99999);
                Mail::to($request->email)->send(new ProfileEmail($code));
                $user->update(['code' => $code]);
                return view('website.check-code');
    
            }else{
                return redirect()->back()->with('error','Email Not Found');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function checkCode(Request $request)
    {
        $request->validate(['code' => 'required']);
        $user = Observe::where('code',$request->code)->first();
        if($user)
        {
            return view('website.change-password',['id'=>$user->id]);    
        }else{
            $code = rand(10000, 99999);
            Mail::to($user->email)->send(new ProfileEmail($code));
            $user->update(['code' => $code]);
            return redirect()->back()->with('error', 'Invaild Code Another Code Resend To Your Email');
        }
    }



    public function changePassword(Request $request,$id)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        $user = Observe::findOrFail($id);
        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->with('error', 'Password Not Same');
        }else{
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('login.view')->with('success', 'Password Change');
        }        
    }
    public function logout()
    {
        auth('observe')->logout();
        return redirect('/');
    }
}
