<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\RiwayatPublikController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\Admin\GejalaController;
use App\Http\Controllers\Admin\PengetahuanController;
use App\Http\Controllers\Admin\RiwayatAdminController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/konsultasi/biodata', [KonsultasiController::class, 'biodata'])->name('konsultasi.biodata');
Route::post('/konsultasi/biodata', [KonsultasiController::class, 'simpanBiodata'])->name('konsultasi.biodata.post');
Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi');
Route::post('/konsultasi', [KonsultasiController::class, 'proses'])->name('konsultasi.proses');
Route::post('/konsultasi/{kodeSesi}/update-biodata', [KonsultasiController::class, 'updateBiodata'])->name('konsultasi.biodata.update');
Route::get('/riwayat', [RiwayatPublikController::class, 'index'])->name('riwayat');
Route::get('/info', [InfoController::class, 'index'])->name('info');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH ROUTES (no middleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Data Penyakit
    Route::get('/penyakit', [PenyakitController::class, 'index'])->name('penyakit.index');
    Route::post('/penyakit', [PenyakitController::class, 'store'])->name('penyakit.store');
    Route::put('/penyakit/{penyakit}', [PenyakitController::class, 'update'])->name('penyakit.update');
    Route::delete('/penyakit/{penyakit}', [PenyakitController::class, 'destroy'])->name('penyakit.destroy');

    // Data Gejala
    Route::get('/gejala', [GejalaController::class, 'index'])->name('gejala.index');
    Route::post('/gejala', [GejalaController::class, 'store'])->name('gejala.store');
    Route::put('/gejala/{gejala}', [GejalaController::class, 'update'])->name('gejala.update');
    Route::delete('/gejala/{gejala}', [GejalaController::class, 'destroy'])->name('gejala.destroy');

    // Basis Pengetahuan
    Route::get('/pengetahuan', [PengetahuanController::class, 'index'])->name('pengetahuan.index');
    Route::post('/pengetahuan', [PengetahuanController::class, 'store'])->name('pengetahuan.store');
    Route::put('/pengetahuan/{rule}', [PengetahuanController::class, 'update'])->name('pengetahuan.update');
    Route::delete('/pengetahuan/{rule}', [PengetahuanController::class, 'destroy'])->name('pengetahuan.destroy');

    // Riwayat Konsultasi
    Route::get('/riwayat', [RiwayatAdminController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/{riwayat}', [RiwayatAdminController::class, 'show'])->name('riwayat.show');
    Route::delete('/riwayat/{riwayat}', [RiwayatAdminController::class, 'destroy'])->name('riwayat.destroy');
});