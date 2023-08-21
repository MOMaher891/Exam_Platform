<?php

use App\Http\Controllers\Inspector\AuthController;
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

Route::fallback(function () {
    return view('errors.404');
});
