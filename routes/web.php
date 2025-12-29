<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\SetorSampahController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::resource('dashboard', DashboardController::class)       
    ->middleware('auth');
Route::resource('profile', ProfileController::class)
    ->middleware('auth');
Route::resource('user', UserController::class)
    ->middleware('auth');
Route::resource('sampah', SampahController::class)
    ->middleware('auth');
Route::resource('setor',SetorSampahController::class)
    ->middleware('auth');
Route::resource('laporan', LaporanController::class)
    ->middleware('auth');

Route::get('login', [LoginController::class, 'login'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [LoginController::class, 'authenticate'])
    ->middleware('guest');

Route::post('logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('register', [RegisterController::class, 'register'])
    ->name('register')
    ->middleware('guest');

Route::post('register', [RegisterController::class, 'store']);

Route::get('verify-email/{token}', [RegisterController::class, 'verifyEmail'])
    ->name('verify.email');

Route::post('resend-verification-email', [RegisterController::class, 'resendVerificationEmail'])
    ->name('resend.verification.email');