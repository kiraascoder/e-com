<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KetuaBidangController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::middleware('authenticated')->group(function () {
    Route::get('login', [SesiController::class, 'loginView'])->name('login');
    Route::post('login', [SesiController::class, 'login'])->name('login.submit');
    Route::get('register', [SesiController::class, 'registerView'])->name('register');
    Route::post('register', [SesiController::class, 'register'])->name('register.submit');
});

Route::prefix('warga')->middleware('role:warga')->group(function () {
    Route::get('dashboard', [WargaController::class, 'index'])->name('warga.dashboard');
    Route::get('edit-profile', [WargaController::class, 'profile'])->name('warga.profile');
    Route::get('laporan', [WargaController::class, 'laporan'])->name('warga.laporan');
    Route::get('buat-laporan', [WargaController::class, 'buatLaporan'])->name('warga.buat.laporan');
    Route::get('store-laporan', [WargaController::class, 'storeLaporan'])->name('warga.laporan.store');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/bidang', [AdminController::class, 'bidang'])->name('admin.bidang');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');

});

// Ketua Bidang Routes  
Route::prefix('ketua')->middleware(['auth', 'role:ketua_bidang'])->group(function () {
    Route::get('/dashboard', [KetuaBidangController::class, 'index'])->name('ketua.dashboard');
    Route::get('/tim', [KetuaBidangController::class, 'tim'])->name('ketua.tim');
    Route::get('/daftar-laporan', [KetuaBidangController::class, 'laporan'])->name('ketua.laporan');
    Route::get('/review-laporan', [KetuaBidangController::class, 'review'])->name('ketua.review');
});

// Anggota Routes
Route::prefix('pegawai')->middleware(['auth', 'role:pegawai'])->group(function () {
    Route::get('/dashboard', [PegawaiController::class, 'index'])->name('pegawai.dashboard');
    Route::get('/tim', [PegawaiController::class, 'tim'])->name('pegawai.tim');
    Route::get('/laporan', [PegawaiController::class, 'laporan'])->name('pegawai.laporan');
});

Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
