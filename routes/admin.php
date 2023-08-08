<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
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
            Route::get('/','index')->name(config('app.admin').$prefix.'index');
            Route::get('/create','create')->name(config('app.admin').$prefix.'create');
            Route::get('/edit/{stf_id}','edit')->name(config('app.admin').$prefix.'edit');
            //Post Functions
            Route::post('/store','store')->name(config('app.admin').$prefix.'store');
            Route::post('update','update')->name(config('app.admin').$prefix.'update');
            Route::get('/delete/{stf_id}','delete')->name(config('app.admin').$prefix.'delete');
        });
    });


});




