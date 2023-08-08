<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\staffValidation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    /**
     * View Functions
     */
    public function index(){
        try{
            //Get Users
            $staff = User::with(['roles'=>function($q){
                $q->whereIn('name',['analyst','admin']);
            }])->get();

            //Filter Staff (Admin & Analyst)
            $staff = $staff->filter(function ($object) {
                return isset($object->roles[0]) && $object->roles[0] !== null;
            });

            return view('dashboard.staff.index',compact('staff'));

        }catch(\Exception $ex){
            return view('errors.500');
        }
    }

    public function create(){
        try{
            $roles = DB::table('roles')->orderBy('id', 'asc')->get()->slice(1); // Skip the first row (Super Admin)
            return view('dashboard.staff.create',compact('roles'));
        }catch(\Exception $ex){
            return view('errors.500');
        }

    }

    public function edit($stf_id){
        try{
            $user = User::with(['roles'=>function($q){$q->select('id','name','display_name');}])->findOrFail($stf_id);
            $roles = DB::table('roles')->orderBy('id', 'asc')->get()->slice(1);
            return view('dashboard.staff.edit',compact('user','roles'));
        }catch(\Exception $ex){
            return view('errors.500');
        }
    }

    /**
     * Functionality Functions
     */
    public function store(staffValidation $request){
        $request->validated();
        try{
            DB::beginTransaction();
            //Create User
            $user = User::create(array_merge($request->except(['_token','role']),['password' => Hash::make($request->input('password'))]));
            //Create role for this user
            $user->attachRole($request->role);
            DB::commit();

            return redirect()->back()->with(['success'=>'Data saved successfully!']);

        }catch(\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with(['error'=>'There are error , Try again later...']);
        }
    }

    public function update(Request $request){
        try{
            /**
             * Validation
             */
            $validator = Validator::make($request->all(), [
                'name'=>'required|string',
                'phone'=>'required|string|max:20|min:5',
                'role'=>'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($request->id), //Check Email expect his email
                ],
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            //Check User exist or not
            $user = User::findOrFail($request->id);
            if(!$user){
                return redirect()->back()->with(['error'=>"Some thing error ,Please try again later ..."]);
            }
            else{

                DB::beginTransaction();
                $user->update($request->only(['name','email','phone']));
                //Update User in role table
                $user->syncRoles([$request->role]);
                DB::commit();
                return redirect()->back()->with(['success'=>"Data saved successfully!"]);
            }
        }catch(\Exception $ex){
            DB::rollBack();
            return view('errors.500');
        }
    }

    public function delete($stf_id){
        try{
            $user = User::findOrFail($stf_id);
            if (!$user ){
                return redirect()->back()->with(['error'=>"Some thing error ,Please try again later ..."]);
            }

            $user->delete();
            return redirect()->back()->with(['success'=>"Data Deleted successfully!"]);
        }
        catch(\Exception $ex){
            return view('errors.500');
        }
    }


}
