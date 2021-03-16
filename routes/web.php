<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Profile;

Route::get('/', function () {
    return redirect('login');
});

Route::get('auth/login', function () {
    return redirect('login');
});

Route::get('login', [LoginController::class, 'index'])
    ->name('login.index');

Route::post('auth/login', [LoginController::class, 'login'])
    ->name('auth.login');

Route::get('auth/login', function () {
    return redirect('login');
});

Route::get('auth/logout', [LoginController::class, 'logout'])
    ->name('auth.logout');

Route::get('register', [RegisterController::class, 'index'])
    ->name('register.index');

Route::post('auth/register', [RegisterController::class, 'register'])
    ->name('auth.register');

Route::get('auth/register', function () {
    return redirect('register');
});

Route::group(['middleware' => 'auth'], function () {

    Route::put('api/profile', [Profile::class, 'index'])
        ->name('profile.update');

    Route::group(['middleware' => 'admin'], function () {
        include('admin.php');
    });

    Route::group(['middleware' => 'member'], function () {
        include('member.php');
    });
});
