<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:superadmin']);
    }
    /**
     * View Functions
     */
    public function index(){
        try{
            return view('dashboard.category.index');
        }catch(\Exception $ex){
            return view('errors.500');
        }
    }

    public function data(){

        $data = Category::query()->latest();
        return DataTables::of($data)->addColumn('action',function($data){
            return view('dashboard.category.action',['category'=>$data,'type'=>'action']);
        })->make(true);
    }

    public function create(){
        try{
            return view('dashboard.category.create');
        }catch(\Exception $ex){
            return view('errors.500');
        }

    }

    public function edit($category_id){
        try{
            $category = Category::find($category_id);
            if(!$category){
                return view('errors.404');
            }
            return view('dashboard.category.edit',compact('category'));
        }catch(\Exception $ex){
            return view('errors.500');
        }
    }

    /**
     * Functionality Functions
     */
    public function store(Request $request){
        /**
         * Validation
         */
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                Rule::unique('categories')->ignore($request->id), //Check Name In exam table
            ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try{
            //Create Exam
            Category::create($request->except('_token'));
            return redirect()->back()->with(['success'=>'Data saved successfully!']);

        }catch(\Exception $ex){
            return redirect()->back()->with(['error'=>'There are error , Try again later...']);
        }
    }

    public function update(Request $request){
        try{
            /**
             * Validation
             */
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    'string',
                    Rule::unique('categories')->ignore($request->id), //Check Name In exam table
                ],
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            //Check User exist or not
            $category = Category::find($request->id);
            if(!$category){
                return view('errors.404');
            }
            else{
                $category->update($request->except('_token'));
                return redirect()->back()->with(['success'=>"Data saved successfully!"]);
            }
        }catch(\Exception $ex){
            return view('errors.500');
        }
    }

    public function delete($category_id){
        try{
            $category = Category::find($category_id);
            if (!$category ){
                return view('errors.500');
            }
            $category->delete();
            return response()->json(['success'=>"Data deleted successfully!"]);
        }
        catch(\Exception $ex){
            return view('errors.500');
        }
    }


}
