<?php

use App\Http\Controllers\Inspector\AuthController;
use App\Http\Controllers\Inspector\ExamController;
use App\Http\Controllers\Inspector\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('website.home');
})->name('home');
Route::group(['controller' => AuthController::class], function () {
    Route::get('/signup', 'registerView')->name('register.view');
    Route::get('/signin', 'loginView')->name('login.view');
    Route::post('/register', 'register')->name('register');
    Route::post('/signin', 'login')->name('login');
});

Route::group(['middleware' => 'auth:observe'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('inspector.logout');
    Route::get('dashboard', [HomeController::class, 'index'])->name('inspector.home');
    // Route::get('exams',[ExamController::class,'index'])->name('inspector.exam.index');
    // Route::get('exams',[ExamController::class,'index'])->name('inspector.exam.index');
    Route::group(['prefix' => 'exam', 'controller' => ExamController::class], function () {
        Route::get('/', 'index')->name('inspector.exam.index');
        Route::get('/data', 'data')->name('inspector.exam.data');
        Route::get('/apply', 'apply')->name('inspector.exam.apply')->middleware('block_observe');
    });
});

Route::fallback(function () {
    return view('errors.404');
});
