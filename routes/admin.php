<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CenterController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ExamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'admin'],function(){
    /**
     * Auth Routes
     */
    Route::group(['controller'=>AuthController::class],function()
    {
        Route::get('login','loginView')->name(config('app.admin').'login.view')->middleware('guest');
        Route::post('login','login')->name(config('app.admin').'login')->middleware('guest');
        Route::get('logout','logout')->name(config('app.admin').'logout')->middleware('auth');
    });

    /**
     * Dashboard Routes
     */

    Route::group(['middleware'=>['auth']],function(){
        //Home
        Route::get('/',[HomeController::class,'index'])->name('admin');

        /**
        * Staff routes
        */
        Route::group(['controller'=>StaffController::class,'prefix'=>'staff'],function(){
            $prefix = 'staff.';
            //Get Functions
            Route::get('/','index')->middleware('permission:show_staff')->name(config('app.admin').$prefix.'index');
            Route::get('/create','create')->middleware('permission:add_staff')->name(config('app.admin').$prefix.'create');
            Route::get('/edit/{stf_id}','edit')->middleware('permission:edit_staff')->name(config('app.admin').$prefix.'edit');
            Route::get('data','data')->middleware('permission:show_staff')->name($prefix.'data');
            //Post Functions
            Route::post('/store','store')->middleware('permission:add_staff')->name(config('app.admin').$prefix.'store');
            Route::post('update','update')->middleware('permission:edit_staff')->name(config('app.admin').$prefix.'update');
            Route::get('/delete/{stf_id}','delete')->middleware('permission:delete_staff')->name(config('app.admin').$prefix.'delete');
        });

        /**
        * Exam routes
        */
        Route::group(['controller'=>ExamController::class,'prefix'=>'exam'],function(){
            $prefix = 'exam.';
            //Get Functions
            Route::get('/','index')->middleware('permission:show_exam')->name(config('app.admin').$prefix.'index');
            Route::get('/create','create')->middleware('permission:add_exam')->name(config('app.admin').$prefix.'create');
            Route::get('/edit/{exam_id}','edit')->middleware('permission:edit_exam')->name(config('app.admin').$prefix.'edit');
            Route::get('data','data')->middleware('permission:show_exam')->name($prefix.'data');
            //Post Functions
            Route::post('/store','store')->middleware('permission:add_exam')->name(config('app.admin').$prefix.'store');
            Route::post('update','update')->middleware('permission:edit_exam')->name(config('app.admin').$prefix.'update');
            Route::delete('/delete/{exam_id}','delete')->middleware('permission:delete_exam')->name(config('app.admin').$prefix.'delete');
        });

        /**
        * Category routes
        */
        Route::group(['controller'=>CategoriesController::class,'prefix'=>'category'],function(){
            $prefix = 'category.';
            //Get Functions
            Route::get('/','index')->middleware('permission:show_category')->name(config('app.admin').$prefix.'index');
            Route::get('/create','create')->middleware('permission:add_category')->name(config('app.admin').$prefix.'create');
            Route::get('/edit/{category_id}','edit')->middleware('permission:edit_category')->name(config('app.admin').$prefix.'edit');
            Route::get('data','data')->middleware('permission:show_category')->name($prefix.'data');
            //Post Functions
            Route::post('/store','store')->middleware('permission:add_category')->name(config('app.admin').$prefix.'store');
            Route::post('update','update')->middleware('permission:edit_category')->name(config('app.admin').$prefix.'update');
            Route::delete('/delete/{category_id}','delete')->middleware('permission:delete_category')->name(config('app.admin').$prefix.'delete');
        });

        /**
         * Role Routes
         */
        Route::group(['controller'=>RoleController::class,'prefix'=>'roles'],function()
        {
            $prefix = 'role.';
            //Get Functions
            Route::get('/','index')->middleware('permission:show_roles')->name($prefix.'index');
            Route::get('/create','create')->middleware('permission:add_roles')->name($prefix.'create');
            Route::get('data','data')->middleware('permission:show_roles')->name($prefix.'data');
            Route::get('{id}/edit','edit')->middleware('permission:edit_roles')->name($prefix.'edit');
            //Post Functions
            Route::post('/store','store')->middleware('permission:add_roles')->name($prefix.'store');
            Route::post('{id}/update','update')->middleware('permission:edit_roles')->name($prefix.'update');
        });

        /**
        * Permission Routes
        */
        Route::group(['controller'=>PermissionController::class,'prefix'=>'permissions'],function()
        {
            $prefix = 'permission.';
            //Get Functions
            Route::get('{id}/edit','index')->name($prefix.'edit');
            //Post Functions
            Route::post('{id}/update','update')->name($prefix.'update');
        });

        
        Route::group(['controller'=>CenterController::class,'prefix'=>'center'],function()
        {
            $prefix = 'center';
            Route::get('/','index')->middleware('permission:show_center')->name(config('app.admin').$prefix.'.index');
            Route::get('/create','create')->middleware('permission:add_center')->name(config('app.admin').$prefix.'.create');
            Route::get('data','data')->middleware('permission:show_center')->name(config('app.admin').$prefix.'.data');
            Route::get('{id}/edit','edit')->middleware('permission:edit_center')->name(config('app.admin').$prefix.'.edit');
            Route::post('/store','store')->middleware('permission:add_center')->name(config('app.admin').$prefix.'.store');
            Route::post('{id}/update','update')->middleware('permission:edit_center')->name(config('app.admin').$prefix.'.update');
            Route::post('/upload-excel','uploadCenters')->middleware('permission:add_center')->name(config('app.admin').$prefix.'.upload-center');
            Route::get('delete/{id}','delete')->middleware('permission:delete_center')->name(config('app.admin').$prefix.'.delete');
        
        });

        Route::group(['controller'=>ProfileController::class,'prefix'=>'profile'],function()
        {
            $prefix = 'profile';
            Route::get('/','index')->name('profile.index');
            Route::get('send-mail','sendEmail')->name('profile.send-email');

            Route::get('check-code','checkCode')->name('profile.check');
            Route::post('change-password','changePassword')->name('profile.change-password');
            Route::post('update','update')->name('profile.update');


        
        });
    });


});
// Route::group(['controller'=>RoleController::class,'prefix'=>'admin/roles'],function()
// {
//     Route::get('/','index')->middleware('permission:show_roles')->name('role.index');
//     Route::get('/create','create')->middleware('permission:add_roles')->name('role.create');
//     Route::get('data','data')->middleware('permission:show_roles')->name('role.data');
//     Route::get('{id}/edit','edit')->middleware('permission:edit_roles')->name('role.edit');
//     Route::post('/store','store')->middleware('permission:add_roles')->name('role.store');
//     Route::post('{id}/update','update')->middleware('permission:edit_roles')->name('role.update');
// });

// Route::group(['controller'=>PermissionController::class,'prefix'=>'admin/permissions'],function()
// {
//     Route::get('{id}/edit','index')->name('permission.edit');
//     Route::post('{id}/update','update')->name('permission.update');
// });


