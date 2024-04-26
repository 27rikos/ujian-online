<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login/auth', [LoginController::class, 'authenticate'])->name('proses');
Route::post('/login/out', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegistrationController::class, 'index'])->name('registrasi');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['UserCheck:admin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
    });
});
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['UserCheck:dosen']], function () {
        Route::get('/dashboard-dosen', [DosenController::class, 'index']);
    });
});
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['UserCheck:mahasiswa']], function () {
        Route::get('/dashboard-mahasiswa', [MahasiswaController::class, 'index']);
    });
});