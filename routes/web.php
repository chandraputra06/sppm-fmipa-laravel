<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\PublicPrestasiController;
use App\Http\Controllers\KomentarController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])
    ->name('admin.login')
    ->middleware('guest:admin');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return "<h1 style='font-family: sans-serif;'>🎉 Selamat datang di Dashboard Admin!</h1>";
    })->name('dashboard');
});

Route::get('/', [PublicPrestasiController::class, 'home'])->name('home');
Route::get('/prestasi', [PublicPrestasiController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/{id}', [PublicPrestasiController::class, 'show'])->name('prestasi.show');

// komentar hanya untuk mahasiswa login
Route::post('/prestasi/{id}/komentar', [KomentarController::class, 'store'])
    ->middleware('auth')
    ->name('prestasi.komentar.store');


require __DIR__.'/auth.php';
