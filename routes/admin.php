<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\PermissionController;
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
            Route::get('/','index')->middleware('permission:show_staff')->name(config('app.admin').$prefix.'index');
            Route::get('/create','create')->middleware('permission:add_staff')->name(config('app.admin').$prefix.'create');
            Route::get('/edit/{stf_id}','edit')->middleware('permission:edit_staff')->name(config('app.admin').$prefix.'edit');
            //Post Functions
            Route::post('/store','store')->middleware('permission:add_staff')->name(config('app.admin').$prefix.'store');
            Route::post('update','update')->middleware('permission:edit_staff')->name(config('app.admin').$prefix.'update');
            Route::get('/delete/{stf_id}','delete')->middleware('permission:delete_staff')->name(config('app.admin').$prefix.'delete');
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
    });


});





