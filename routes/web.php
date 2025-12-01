<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\CucianController;
use App\Http\Controllers\PenyimpananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanPendapatanController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    
    // Pesanan Routes
    Route::resource('pesanan', PesananController::class);
    
    // Cucian Routes
    Route::resource('cucian', CucianController::class);
    
    // Penyimpanan Routes
    Route::resource('penyimpanan', PenyimpananController::class);
    
    // Pembayaran Routes
    Route::resource('pembayaran', PembayaranController::class);
    
    // Laporan Admin
    Route::get('/laporan', [LaporanPendapatanController::class, 'admin'])->name('laporan');
    Route::get('/laporan/export-pdf', [LaporanPendapatanController::class, 'exportPdf'])->name('laporan.pdf');
});

// Owner Routes
Route::middleware('auth')->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'owner'])->name('dashboard');
    Route::get('/laporan', [LaporanPendapatanController::class, 'index'])->name('laporan');
    Route::get('/laporan/export-pdf', [LaporanPendapatanController::class, 'exportPdf'])->name('laporan.pdf');
    Route::get('/laporan/export-daily-pdf', [LaporanPendapatanController::class, 'exportDailyPdf'])->name('laporan.daily.pdf');
});
