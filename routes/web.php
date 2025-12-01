<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;

// =========================
// ROUTE PUBLIC (GUEST & MAHASISWA)
// =========================

Route::get('/', [PrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show');
Route::post('/prestasi/{id}/komentar', [KomentarController::class, 'store'])->name('komentar.store');

// =========================
// ROUTE ADMIN
// =========================

Route::prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/prestasi', [AdminPrestasiController::class, 'index']);
    Route::post('/prestasi', [AdminPrestasiController::class, 'store']);
    Route::get('/prestasi/{id}', [AdminPrestasiController::class, 'show']);
    Route::put('/prestasi/{id}', [AdminPrestasiController::class, 'update']);
    Route::delete('/prestasi/{id}', [AdminPrestasiController::class, 'destroy']);

    // ubah status (Draft / Diverifikasi / Dipublikasikan)
    Route::post('/prestasi/{id}/status', [AdminPrestasiController::class, 'updateStatus']);
});