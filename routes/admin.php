<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CenterController;
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
    Route::group(['middleware'=>['auth'],],function(){
        //Dashboard Home
        Route::get('/',[HomeController::class,'index'])->name('admin');

        /**
        * Dashboard Staff routes
        */
        Route::group(['controller'=>StaffController::class,'prefix'=>'staff'],function(){
            //Get Functions
            $prefix = 'staff.';
            Route::get('/','index')->middleware('permission:show_staff')->name(config('app.admin').$prefix.'index');
            Route::get('/create','create')->middleware('permission:add_staff')->name(config('app.admin').$prefix.'create');
            Route::get('/edit/{stf_id}','edit')->middleware('permission:edit_staff')->name(config('app.admin').$prefix.'edit');
            //Post Functions
            Route::post('/store','store')->middleware('permission:add_staff')->name(config('app.admin').$prefix.'store');
            Route::post('update','update')->middleware('permission:edit_staff')->name(config('app.admin').$prefix.'update');
            Route::get('/delete/{stf_id}','delete')->middleware('permission:delete_staff')->name(config('app.admin').$prefix.'delete');
        });
    });


});
Route::group(['controller'=>RoleController::class,'prefix'=>'admin/roles'],function()
{
    Route::get('/','index')->middleware('permission:show_roles')->name('role.index');
    Route::get('/create','create')->middleware('permission:add_roles')->name('role.create');
    Route::get('data','data')->middleware('permission:show_roles')->name('role.data');
    Route::get('{id}/edit','edit')->middleware('permission:edit_roles')->name('role.edit');
    Route::post('/store','store')->middleware('permission:add_roles')->name('role.store');
    Route::post('{id}/update','update')->middleware('permission:edit_roles')->name('role.update');
});

Route::group(['controller'=>CenterController::class,'prefix'=>'admin/center'],function()
{
    Route::get('/','index')->middleware('permission:show_center')->name('center.index');
    Route::get('/create','create')->middleware('permission:add_center')->name('center.create');
    Route::get('data','data')->middleware('permission:show_center')->name('center.data');
    Route::get('{id}/edit','edit')->middleware('permission:edit_center')->name('center.edit');
    Route::post('/store','store')->middleware('permission:add_center')->name('center.store');
    Route::post('{id}/update','update')->middleware('permission:edit_center')->name('center.update');
});

Route::group(['controller'=>PermissionController::class,'prefix'=>'admin/permissions'],function()
{
    Route::get('{id}/edit','index')->name('permission.edit');
    Route::post('{id}/update','update')->name('permission.update');
});


