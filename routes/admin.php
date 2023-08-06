<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
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

Route::get('/admin',[HomeController::class,'index'])->name('admin')->middleware('auth');
Route::get('admin/login',[HomeController::class,'get_login_form']);


Route::group(['controller'=>AuthController::class,'prefix'=>'admin'],function()
{
    Route::get('login','loginView')->name('admin.login.view')->middleware('guest');
    Route::post('login','login')->name('admin.login')->middleware('guest');
    Route::get('logout','logout')->name('admin.logout')->middleware('auth');
});
