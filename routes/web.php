<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DataBukuController;
use App\Http\Controllers\DataAnggotaController;
use App\Http\Controllers\PeminjamanBukuController;
use App\Http\Controllers\DashboardController;

// Halaman awal (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Route bawaan auth (login, register, dll)
Auth::routes();

// Ubah ini jika ingin arahkan ke /dashboard setelah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Proteksi semua route yang butuh login pakai middleware auth
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Data Buku
    Route::resource('databuku', DataBukuController::class);

    // CRUD Data Anggota
    Route::resource('dataanggota', DataAnggotaController::class);

    // CRUD Peminjaman Buku
    Route::resource('peminjaman', PeminjamanBukuController::class);
});
