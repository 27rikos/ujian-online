<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DosenDataController;
use App\Http\Controllers\DosenMatakuliahController;
use App\Http\Controllers\DosenSoalController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaDataController;
use App\Http\Controllers\MahasiswaMatakuliahController;
use App\Http\Controllers\MahasiswaSoalController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\NilaiOnDosenController;
use App\Http\Controllers\NilaiOnMahasiswaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SoalController;
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
Route::get('/login/out', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegistrationController::class, 'index'])->name('registrasi');
Route::post('/register/proses', [RegistrationController::class, 'register'])->name('daftar');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['UserCheck:admin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource("mahasiswa", MahasiswaDataController::class);
        Route::resource("Dosen", DosenDataController::class);
        Route::resource("matakuliah", MatakuliahController::class);
        Route::resource("jadwal", JadwalController::class);
        Route::get('soal/{id}', [SoalController::class, 'index']);
        Route::get('soal/create/{id}', [SoalController::class, 'create']);
        Route::post('soal/store/{id}', [SoalController::class, 'store']);
        Route::get('soal/{soal}/edit/{matakuliah}', [SoalController::class, 'edit']);
        Route::put('soal/{soal}/update/{matakuliah}', [SoalController::class, 'update']);
        Route::delete('soal/{soal}/delete/{matakuliah}', [SoalController::class, 'destroy']);
        Route::get('nilai-matakuliah', [NilaiController::class, 'index'])->name('nilai');
        Route::get('show-nilai/{id}', [NilaiController::class, 'show']);
        Route::get('show-nilai/{id}/edit/{id_nilai}', [NilaiController::class, 'edit']);
        Route::put('show-nilai/{id}/update/{id_nilai}', [NilaiController::class, 'update']);
        Route::get('generate-pdf/{id}', [PDFController::class, 'adminpdf']);
    });

});
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['UserCheck:dosen']], function () {
        Route::get('/dashboard-dosen', [DosenController::class, 'index'])->name('dashboard-dosen');
        Route::resource('matakuliah-dosen', DosenMatakuliahController::class);
        Route::get('soal-dosen/{id}', [DosenSoalController::class, 'index']);
        Route::get('soal-dosen/create/{id}', [DosenSoalController::class, 'create']);
        Route::post('soal-dosen/store/{id}', [DosenSoalController::class, 'store']);
        Route::get('soal-dosen/{soal}/edit/{matakuliah}', [DosenSoalController::class, 'edit']);
        Route::put('soal-dosen/{soal}/update/{matakuliah}', [DosenSoalController::class, 'update']);
        Route::delete('soal-dosen/{soal}/delete/{matakuliah}', [DosenSoalController::class, 'destroy']);
        Route::get('dosen-nilai-matakuliah', [NilaiOnDosenController::class, 'index'])->name('nilai-dosen');
        Route::get('dosen-show-nilai/{id}', [NilaiOnDosenController::class, 'show']);
        Route::get('dosen-show-nilai/{id}/edit/{id_nilai}', [NilaiOnDosenController::class, 'edit']);
        Route::put('dosen-show-nilai/{id}/update/{id_nilai}', [NilaiOnDosenController::class, 'update']);
        Route::get('generate/{id}', [PDFController::class, 'dosenpdf']);

    });
});
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['UserCheck:mahasiswa']], function () {
        Route::get('/dashboard-mahasiswa', [MahasiswaController::class, 'index'])->name('dashboard-mahasiswa');
        Route::get('mahasiswa-matakuliah-uts', [MahasiswaMatakuliahController::class, 'uts'])->name('mahasiswa-matakuliah-uts');
        Route::get('mahasiswa-matakuliah-uas', [MahasiswaMatakuliahController::class, 'uas'])->name('mahasiswa-matakuliah-uas');
        Route::get('soal-mahasiswa/{id}/uts', [MahasiswaSoalController::class, 'uts']);
        Route::get('soal-mahasiswa/{id}/uas', [MahasiswaSoalController::class, 'uas']);
        Route::post('simpan-jawaban/{id_matakuliah}/uts', [JawabanController::class, 'uts']);
        Route::post('simpan-jawaban/{id_matakuliah}/uas', [JawabanController::class, 'uas']);
        Route::get('mahasiswa-nilai', [NilaiOnMahasiswaController::class, 'index'])->name('mahasiswa-nilai');
        Route::get('mahasiswa-show-nilai/{id}', [NilaiOnMahasiswaController::class, 'show']);
    });
});