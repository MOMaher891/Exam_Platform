<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CenterController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ExamTimeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\InspectorController;


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

Route::group(['prefix' => 'admin'], function () {
    /**
     * Auth Routes
     */
    Route::group(['controller' => AuthController::class], function () {
        Route::get('login', 'loginView')->name(config('app.admin') . 'login.view')->middleware('guest');
        Route::post('login', 'login')->name(config('app.admin') . 'login')->middleware('guest');
        Route::get('logout', 'logout')->name(config('app.admin') . 'logout')->middleware('auth');
    });

    /**
     * Dashboard Routes
     */

    Route::group(['middleware' => ['auth']], function () {
        //Home
        Route::get('/', [HomeController::class, 'index'])->name('admin');

        /**
         * Staff routes
         */
        Route::group(['controller' => StaffController::class, 'prefix' => 'staff'], function () {
            $prefix = 'staff.';
            //Get Functions
            Route::get('/', 'index')->middleware('permission:show_staff')->name(config('app.admin') . $prefix . 'index');
            Route::get('/create', 'create')->middleware('permission:add_staff')->name(config('app.admin') . $prefix . 'create');
            Route::get('/edit/{stf_id}', 'edit')->middleware('permission:edit_staff')->name(config('app.admin') . $prefix . 'edit');
            Route::get('data', 'data')->middleware('permission:show_staff')->name($prefix . 'data');
            //Post Functions
            Route::post('/store', 'store')->middleware('permission:add_staff')->name(config('app.admin') . $prefix . 'store');
            Route::post('update', 'update')->middleware('permission:edit_staff')->name(config('app.admin') . $prefix . 'update');
            Route::get('/delete/{stf_id}', 'delete')->middleware('permission:delete_staff')->name(config('app.admin') . $prefix . 'delete');

            Route::get('change-password/{id}','changePasswordView')->name(config('app.admin').$prefix.'change-password-view');
            Route::post('change-password/{id}','changePassword')->name(config('app.admin').$prefix.'change-password');
            
        });

        /**
         * Exam routes
         */
        Route::group(['controller' => ExamController::class, 'prefix' => 'exam'], function () {
            $prefix = 'exam.';
            //Get Functions
            Route::get('/', 'index')->middleware('permission:show_exam')->name(config('app.admin') . $prefix . 'index');
            Route::get('/create', 'create')->middleware('permission:add_exam')->name(config('app.admin') . $prefix . 'create');
            Route::get('/edit/{exam_id}', 'edit')->middleware('permission:edit_exam')->name(config('app.admin') . $prefix . 'edit');
            Route::get('{exam_id}/centers/', 'centers_show')->middleware('permission:show_exam')->name(config('app.admin') . $prefix . 'centers_show');
            Route::get('center_data/{exam_id}', 'centers_data')->middleware('permission:show_exam')->name($prefix . 'center_data');
            Route::get('{exam_id}/attendance/', 'attendance_show')->middleware('permission:show_exam')->name(config('app.admin') . $prefix . 'attendance_show');
            Route::get('attendance_data/{exam_id}', 'attendance_data')->middleware('permission:show_exam')->name($prefix . 'attendance_data');
            Route::get('data', 'data')->middleware('permission:show_exam')->name($prefix . 'data');
            //Post Functions
            Route::post('/store', 'store')->middleware('permission:add_exam')->name(config('app.admin') . $prefix . 'store');
            Route::post('update', 'update')->middleware('permission:edit_exam')->name(config('app.admin') . $prefix . 'update');
            Route::delete('/delete/{exam_id}', 'delete')->middleware('permission:delete_exam')->name(config('app.admin') . $prefix . 'delete');
            Route::post('/payment/{exam_id}', 'payment')->middleware('permission:show_exam')->name(config('app.admin') . $prefix . 'payment');
        });

        /**
         * Inspector routes
         */
        Route::group(['controller' => InspectorController::class, 'prefix' => 'inspector'], function () {
            $prefix = 'inspector.';
            //Get Functions
            Route::get('/', 'index')->middleware('permission:show_inspector')->name(config('app.admin') . $prefix . 'index');
            Route::get('/create', 'create')->middleware('permission:add_inspector')->name(config('app.admin') . $prefix . 'create');
            Route::get('/edit/{inspector_id}', 'edit')->middleware('permission:edit_inspector')->name(config('app.admin') . $prefix . 'edit');
            Route::get('/show/{inspector_id}', 'show')->middleware('permission:show_inspector')->name(config('app.admin') . $prefix . 'show');
            Route::get('data', 'data')->middleware('permission:show_inspector')->name($prefix . 'data');
            Route::get('exam_data', 'exam_data')->middleware('permission:show_inspector')->name($prefix . 'exam_data');
            Route::get('/exams', 'exams')->middleware('permission:show_inspector')->name(config('app.admin') . $prefix . 'exams');
            Route::get('/accept/{inspector_id}', 'accept')->middleware('permission:accept_inspector')->name(config('app.admin') . $prefix . 'accept');
            Route::get('/exam_observe', 'exam_observe')->middleware('permission:show_inspector')->name(config('app.admin') . $prefix . 'exam_observe');
            Route::get('/is_come/{observe_id}', 'is_come')->middleware('permission:show_inspector')->name(config('app.admin') . $prefix . 'is_come');
            Route::post('/reject', 'reject')->middleware('permission:reject_inspector')->name(config('app.admin') . $prefix . 'reject');
            Route::get('/block/{inspector_id}', 'block')->middleware('permission:block_inspector')->name(config('app.admin') . $prefix . 'block');
            Route::get('/delete/{inspector_id}', 'delete')->middleware('permission:delete_inspector')->name(config('app.admin') . $prefix . 'delete');
            Route::get('inspector_center/', 'Inspector_in_center')->middleware('permission:show_inspector')->name(config('app.admin') . $prefix . 'inspector_center');
            Route::get('Inspector_in_center_data/', 'Inspector_in_center_data')->middleware('permission:show_inspector')->name(config('app.admin') . $prefix . 'Inspector_in_center_data');
            //Post Functions
            Route::post('/store', 'store')->middleware('permission:add_inspector')->name(config('app.admin') . $prefix . 'store');
            Route::post('update', 'update')->middleware('permission:edit_inspector')->name(config('app.admin') . $prefix . 'update');
            Route::post('/filter_accounts', 'filter_accounts')->middleware('permission:filter_inspector')->name(config('app.admin') . $prefix . 'filter');

            /**
             * Analyst
             */
            Route::get('{inspector_id}/all_exams', 'all_exams')->middleware('permission:show_inspector')->name(config('app.admin') . $prefix . 'all_exams');
            Route::get('{inspector_id}/all_exams_data', 'all_exams_data')->middleware('permission:show_inspector')->name(config('app.admin') . $prefix . 'all_exams_data');
        });

        /**
         * Category routes
         */
        Route::group(['controller' => CategoriesController::class, 'prefix' => 'category'], function () {
            $prefix = 'category.';
            //Get Functions
            Route::get('/', 'index')->middleware('permission:show_category')->name(config('app.admin') . $prefix . 'index');
            Route::get('/create', 'create')->middleware('permission:add_category')->name(config('app.admin') . $prefix . 'create');
            Route::get('/edit/{category_id}', 'edit')->middleware('permission:edit_category')->name(config('app.admin') . $prefix . 'edit');
            Route::get('data', 'data')->middleware('permission:show_category')->name($prefix . 'data');
            //Post Functions
            Route::post('/store', 'store')->middleware('permission:add_category')->name(config('app.admin') . $prefix . 'store');
            Route::post('update', 'update')->middleware('permission:edit_category')->name(config('app.admin') . $prefix . 'update');
            Route::delete('/delete/{category_id}', 'delete')->middleware('permission:delete_category')->name(config('app.admin') . $prefix . 'delete');
        });

        /**
         * Role Routes
         */
        Route::group(['controller' => RoleController::class, 'prefix' => 'roles'], function () {
            $prefix = 'role.';
            //Get Functions
            Route::get('/', 'index')->middleware('permission:show_roles')->name($prefix . 'index');
            Route::get('/create', 'create')->middleware('permission:add_roles')->name($prefix . 'create');
            Route::get('data', 'data')->middleware('permission:show_roles')->name($prefix . 'data');
            Route::get('{id}/edit', 'edit')->middleware('permission:edit_roles')->name($prefix . 'edit');
            //Post Functions
            Route::post('/store', 'store')->middleware('permission:add_roles')->name($prefix . 'store');
            Route::post('{id}/update', 'update')->middleware('permission:edit_roles')->name($prefix . 'update');
        });

        /**
         * Permission Routes
         */
        Route::group(['controller' => PermissionController::class, 'prefix' => 'permissions'], function () {
            $prefix = 'permission.';
            //Get Functions
            Route::get('{id}/edit', 'index')->name($prefix . 'edit');
            //Post Functions
            Route::post('{id}/update', 'update')->name($prefix . 'update');
        });


        Route::group(['controller' => CenterController::class, 'prefix' => 'center'], function () {
            $prefix = 'center';
            Route::get('/', 'index')->middleware('permission:show_center')->name(config('app.admin') . $prefix . '.index');
            Route::get('/create', 'create')->middleware('permission:add_center')->name(config('app.admin') . $prefix . '.create');
            Route::get('data', 'data')->middleware('permission:show_center')->name(config('app.admin') . $prefix . '.data');
            Route::get('{id}/edit', 'edit')->middleware('permission:edit_center')->name(config('app.admin') . $prefix . '.edit');
            Route::post('/store', 'store')->middleware('permission:add_center')->name(config('app.admin') . $prefix . '.store');
            Route::post('{id}/update', 'update')->middleware('permission:edit_center')->name(config('app.admin') . $prefix . '.update');
            Route::post('/upload-excel', 'uploadCenters')->middleware('permission:add_center')->name(config('app.admin') . $prefix . '.upload-center');
            Route::get('delete/{id}', 'delete')->middleware('permission:delete_center')->name(config('app.admin') . $prefix . '.delete');

            /**
             * Analyst
             */
            Route::get('{center_id}/exams', 'exam_for_center_show')->middleware('permission:show_center')->name(config('app.admin') . $prefix . '.exam_for_center_show');
            Route::get('exams/{center_id}', 'exam_for_center_data')->middleware('permission:show_center')->name(config('app.admin') . $prefix . '.exam_for_center_data');

            Route::get('/{exam_time_id}/attendance', 'inspector_for_exam_show')->middleware('permission:show_inspector')->name(config('app.admin') . $prefix . '.inspector_for_exam_show');
            Route::get('attendance/{exam_time_id}/', 'inspector_for_exam_data')->middleware('permission:show_inspector')->name(config('app.admin') . $prefix . '.inspector_for_exam_data');
        });




        Route::group(['controller' => ExamTimeController::class, 'prefix' => 'exam_times'], function () {
            $prefix = 'exam_times';
            Route::get('/', 'index')->middleware('permission:show_exam_times')->name(config('app.admin') . $prefix . '.index');
            Route::get('{id}/create', 'create')->middleware('permission:add_exam_times')->name(config('app.admin') . $prefix . '.create');
            Route::get('data', 'data')->middleware('permission:show_exam_times')->name(config('app.admin') . $prefix . '.data');
            Route::get('{id}/edit', 'edit')->middleware('permission:edit_exam_times')->name(config('app.admin') . $prefix . '.edit');
            Route::post('{id}/store', 'store')->middleware('permission:add_exam_times')->name(config('app.admin') . $prefix . '.store');
            Route::post('{id}/update', 'update')->middleware('permission:edit_exam_times')->name(config('app.admin') . $prefix . '.update');
            Route::get('delete/{id}', 'delete')->middleware('permission:delete_exam_times')->name(config('app.admin') . $prefix . '.delete');
        });

        Route::group(['controller' => ProfileController::class, 'prefix' => 'profile'], function () {
            $prefix = 'profile';
            Route::get('/', 'index')->name('profile.index');
            Route::get('send-mail', 'sendEmail')->name('profile.send-email');

            Route::get('check-code', 'checkCode')->name('profile.check');
            Route::post('change-password', 'changePassword')->name('profile.change-password');
            Route::post('update', 'update')->name('profile.update');
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
