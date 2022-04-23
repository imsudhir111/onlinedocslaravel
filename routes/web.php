<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\QuestionController; 

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


/*
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\Customer\HomeController::class, 'index'])->name('home');
Route::post('/user/logout', [LoginController::class, 'userLogout'])->name('user.logout');

Route::group(['prefix' => 'admin'], function() {
    Route::group(['middleware' => 'admin.guest'], function(){
        Route::get('/login',[LoginController::class, 'login'])->name('admin.login');
        Route::post('/adminlogin',[LoginController::class, 'authenticate'])->name('admin.auth');
    });

    Route::group(['middleware' => 'admin.auth'], function(){
        Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::resource('/service', ServiceController::class);
        Route::resource('/question', QuestionController::class);
    });
});

//Step 7: Created routes for doctor
Route::group(['prefix' => 'doctor'], function() {
    Route::group(['middleware' => 'doctor.guest'], function(){
        Route::get('/login',[App\Http\Controllers\Doctor\LoginController::class, 'login'])->name('doctor.login');
        Route::post('/doctorlogin',[App\Http\Controllers\Doctor\LoginController::class, 'authenticate'])->name('doctor.auth');
    });

    Route::group(['middleware' => 'doctor.auth'], function(){
        Route::get('/dashboard',[App\Http\Controllers\Doctor\DashboardController::class, 'dashboard'])->name('doctor.dashboard');
        Route::post('/logout', [App\Http\Controllers\Doctor\LoginController::class, 'logout'])->name('doctor.logout');

    });
});

Route::group(['prefix' => 'support'], function() {
    Route::group(['middleware' => 'support.guest'], function(){
        Route::get('/login',[App\Http\Controllers\Support\LoginController::class, 'login'])->name('support.login');
        Route::post('/supportlogin',[App\Http\Controllers\Support\LoginController::class, 'authenticate'])->name('support.auth');
    });

    Route::group(['middleware' => 'support.auth'], function(){
        Route::get('/dashboard',[App\Http\Controllers\Support\DashboardController::class, 'dashboard'])->name('support.dashboard');
        Route::post('/logout', [App\Http\Controllers\Support\LoginController::class, 'logout'])->name('support.logout');

    });
});
