<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Mail\SetupPasswordEmail;

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
    return redirect('login');
});


Auth::routes(['verify' => true]);

Route::get('/setup-password', function () {
    return view('layouts.setup-password');
});

Route::get('/test-email', function () {
    return view('layouts.test-email');
});



Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('create-password', 'App\Http\Controllers\PasswordController@index')->name('create-password');

    Route::get('index', 'App\Http\Controllers\UsersController@export')->name('users-index');

    Route::get('/email/verify/{token}', function () {
        return view('auth.verify');
    })->middleware('auth')->name('verification.notice');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
    Route::group(['middleware' => ['administrator']], function () {
        Route::get('admin-dashboard', 'App\Http\Controllers\AdminController@index')->name('admindashboard');
        Route::resource('users', UserController::class);
    });

    Route::group(['middleware' => ['regularuser']], function () {
        Route::get('regular-dashboard', 'App\Http\Controllers\RegularController@index')->name('regulardashboard');
    });
});
