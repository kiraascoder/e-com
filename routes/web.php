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
    Route::put('edit-profile/update', [WargaController::class, 'profileUpdate'])->name('warga.profile.update');
    Route::get('laporan', [WargaController::class, 'laporan'])->name('warga.laporan');
    Route::get('laporan/{id}/detail', [WargaController::class, 'detailLaporan'])->name('warga.laporan.show');
    Route::delete('laporan/{id}/delete', [WargaController::class, 'destroyLaporan'])->name('warga.laporan.destroy');
    Route::get('buat-laporan', [WargaController::class, 'buatLaporan'])->name('warga.buat.laporan');
    Route::post('store-laporan', [WargaController::class, 'storeLaporan'])->name('warga.laporan.store');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/bidang', [AdminController::class, 'bidang'])->name('admin.bidang');
    Route::post('/bidang/store', [AdminController::class, 'storeBidang'])->name('admin.bidang.store');
    Route::get('/bidang/{id}/detail', [AdminController::class, 'showBidang'])->name('admin.bidang.show');
    Route::delete('/bidang/{id}/delete', [AdminController::class, 'destroyBidang'])->name('admin.bidang.delete');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/detail', [AdminController::class, 'detailUser'])->name('admin.users.detail');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/laporan/{id}/detail', [AdminController::class, 'detailLaporan'])->name('admin.laporan.show');
});

// Ketua Bidang Routes  
Route::prefix('ketua')->middleware(['auth', 'role:ketua_bidang'])->group(function () {
    Route::get('/dashboard', [KetuaBidangController::class, 'index'])->name('ketua.dashboard');
    Route::get('/tim', [KetuaBidangController::class, 'tim'])->name('ketua.tim');
    Route::post('/timrutin-store', [KetuaBidangController::class, 'timRutinStore'])->name('ketua.rutin.store');
    Route::delete('/timrutin/{id}', [KetuaBidangController::class, 'timRutinDestroy'])->name('ketua.rutin.destroy');
    Route::delete('/timnonrutin/{id}', [KetuaBidangController::class, 'timNonRutinDestroy'])->name('ketua.nonrutin.destroy');
    Route::get('/timrutin/{id}/detail', [KetuaBidangController::class, 'timRutinShow'])->name('ketua.rutin.show');
    Route::post('/timrutin/{id}/tambah-anggota', [KetuaBidangController::class, 'storeAnggotaRutin'])->name('ketua.anggota.store');
    Route::post('/timnonrutin/{id}/tambah-anggota', [KetuaBidangController::class, 'storeAnggotaNonRutin'])->name('ketua.nonanggota.store');
    Route::get('/timnonrutin/{id}/detail', [KetuaBidangController::class, 'timNonRutinShow'])->name('ketua.nonrutin.show');
    Route::get('/timnonrutin/{id}/detail-laporan', [KetuaBidangController::class, 'detailLaporan'])->name('ketua.detail-laporan.show');
    Route::get('/laporan/{id}/detail-laporan', [KetuaBidangController::class, 'detailLaporan'])->name('ketua.detail-laporan.single.show');
    Route::get('/laporan/{id}', [KetuaBidangController::class, 'show'])->name('laporan.show');
    Route::post('/laporan/{id}/verify', [KetuaBidangController::class, 'verify'])->name('laporan.verify');
    Route::post('/timnonrutin-store', [KetuaBidangController::class, 'timNonRutinStore'])->name('ketua.nonrutin.store');
    Route::get('/tim/{id}', [KetuaBidangController::class, 'detailTim'])->name('ketua.tim.show');
    Route::get('/daftar-laporan', [KetuaBidangController::class, 'laporan'])->name('ketua.laporan');
    Route::get('/review-laporan', [KetuaBidangController::class, 'review'])->name('ketua.review');
    Route::get('/review/laporan-tugas/{laporanTugas}/', [KetuaBidangController::class, 'showReview'])->name('ketua.review.show');
});

// Anggota Routes
Route::prefix('pegawai')->middleware(['auth', 'role:pegawai'])->group(function () {
    Route::get('/dashboard', [PegawaiController::class, 'index'])->name('pegawai.dashboard');
    Route::get('/tim', [PegawaiController::class, 'tim'])->name('pegawai.tim');
    Route::get('/timrutin/{id}/detail', [PegawaiController::class, 'timRutinShow'])->name('pegawai.rutin.show');
    Route::get('/timnonrutin/{id}/detail', [PegawaiController::class, 'timNonRutinShow'])->name('pegawai.nonrutin.show');
    Route::get('/laporan', [PegawaiController::class, 'laporan'])->name('pegawai.laporan');
    Route::get('/task', [PegawaiController::class, 'task'])->name('pegawai.task');
    Route::get('/tim-non-rutin/{timNonRutin}/laporan-tugas/create', [PegawaiController::class, 'taskSubmit'])
        ->name('pegawai.laporan-tugas.create');
    Route::post('/tim-non-rutin/{timNonRutin}/laporan-tugas', [PegawaiController::class, 'storeTask'])
        ->name('pegawai.laporan-tugas.store');
    Route::get('/laporan/{id}/detail', [PegawaiController::class, 'detailLaporan'])->name('pegawai.laporan.show');
    Route::patch('/tim-non-rutin/{timNonRutin}/status', [PegawaiController::class, 'updateStatus'])
        ->name('pegawai.tim-nonrutin.status')
        ->middleware(['auth']);
});

Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
