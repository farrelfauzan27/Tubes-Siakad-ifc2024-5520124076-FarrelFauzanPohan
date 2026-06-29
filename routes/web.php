<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ===== Khusus Admin =====
    Route::middleware('role:admin')->group(function () {
        Route::resource('dosen', DosenController::class);
        Route::resource('mahasiswa', MahasiswaController::class);
        Route::resource('matakuliah', MataKuliahController::class)
            ->parameters(['matakuliah' => 'matakuliah']);
        Route::resource('jadwal', JadwalController::class);
        Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
        Route::get('/krs/create', [KrsController::class, 'create'])->name('krs.create');
        Route::post('/krs', [KrsController::class, 'storeAdmin'])->name('krs.store.admin');
        Route::get('/krs/export/pdf', [KrsController::class, 'exportPdf'])->name('krs.export.pdf');
        Route::get('/krs/export/excel', [KrsController::class, 'exportExcel'])->name('krs.export.excel');
        Route::get('/krs/{krs}', [KrsController::class, 'show'])->name('krs.show');
        Route::get('/krs/{krs}/edit', [KrsController::class, 'edit'])->name('krs.edit');
        Route::put('/krs/{krs}', [KrsController::class, 'update'])->name('krs.update');
    });

    // ===== Khusus Mahasiswa =====
    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/krs-saya', [KrsController::class, 'my'])->name('krs.my');
        Route::post('/krs-saya', [KrsController::class, 'store'])->name('krs.store');
        Route::get('/krs-saya/export/pdf', [KrsController::class, 'exportMyPdf'])->name('krs.my.export.pdf');
        Route::get('/krs-saya/export/excel', [KrsController::class, 'exportMyExcel'])->name('krs.my.export.excel');
    });

    // Hapus KRS: admin & mahasiswa boleh (otorisasi detail di controller)
    Route::delete('/krs/{krs}', [KrsController::class, 'destroy'])->name('krs.destroy');
});
