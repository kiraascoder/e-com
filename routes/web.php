<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KetuaBidangController;
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
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/bidang', [AdminController::class, 'bidang'])->name('admin.bidang.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.index');
});

// Ketua Bidang Routes  
Route::prefix('ketua')->middleware(['auth', 'role:ketua_bidang'])->group(function () {
    Route::get('/dashboard', [KetuaBidangController::class, 'index'])->name('ketua.dashboard');
    Route::get('/tim-rutin', [KetuaBidangController::class, 'timRutin'])->name('ketua.tim.rutin.index');
    Route::get('/assign-laporan', [KetuaBidangController::class, 'assignLaporan'])->name('ketua.laporan.assign');
});

// Anggota Routes
Route::prefix('anggota')->middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('/dashboard', [AnggotaController::class, 'dashboard'])->name('anggota.dashboard');
    Route::get('/tasks/update', [AnggotaController::class, 'updateTasks'])->name('anggota.tasks.update');
    Route::get('/schedule', [AnggotaController::class, 'schedule'])->name('anggota.schedule.index');
});

Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
