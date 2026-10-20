<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrasiInfluencerController;
use App\Http\Middleware\PastikanPeran;
use Illuminate\Support\Facades\Route;

// Halaman depan (landing page)
Route::get('/', function () {
    return view('landing');
});

// Halaman untuk pengunjung yang BELUM login.
// Pengguna yang sudah login otomatis dialihkan ke route bernama "dashboard".
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegistrasiInfluencerController::class, 'tampilkanForm'])->name('register');
    Route::post('/register', [RegistrasiInfluencerController::class, 'simpan'])->name('register.simpan');

    Route::get('/login', [LoginController::class, 'tampilkanForm'])->name('login');
    Route::post('/login', [LoginController::class, 'masuk'])->name('login.proses');
});

// Halaman untuk pengguna yang SUDAH login
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'keluar'])->name('logout');

    // Pintu masuk setelah login: meneruskan sesuai peran
    Route::get('/dashboard', [DashboardController::class, 'arahkan'])->name('dashboard');

    // Halaman khusus Admin
    Route::middleware(PastikanPeran::class . ':admin')
        ->prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        });

    // Halaman khusus Owner Brand
    Route::middleware(PastikanPeran::class . ':owner_brand')
        ->prefix('owner')->name('owner.')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'ownerBrand'])->name('dashboard');
        });

    // Halaman khusus Influencer
    Route::middleware(PastikanPeran::class . ':influencer')
        ->prefix('influencer')->name('influencer.')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'influencer'])->name('dashboard');
            Route::get('/status-verifikasi', [DashboardController::class, 'statusVerifikasi'])->name('status');
        });
});