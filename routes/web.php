<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\Admin\TiketController as AdminTiketController;
use App\Http\Controllers\Admin\KategoriTiketController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;

// =======================
// Halaman Utama & Event
// =======================
Route::get('/', fn() => view('events.home'));
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');
Route::get('/events/konser', [EventController::class, 'konser'])->name('konser');
Route::get('/events/seminar', [EventController::class, 'seminar'])->name('seminar');
Route::get('/events/pameran', [EventController::class, 'pameran'])->name('pameran');
Route::get('/events/gameshow', [EventController::class, 'gameshow'])->name('gameshow');

// =======================
// Autentikasi
// =======================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// =======================
// Tiket & Pembayaran (User)
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/event/{id}/buy', [TiketController::class, 'create'])->name('tiket.create');
    Route::post('/event/buy', [TiketController::class, 'store'])->name('tiket.store');

    Route::get('/tiket/{id}/success', [TiketController::class, 'success'])->name('tiket.success');
    Route::get('/tiket/{id}/final', [TiketController::class, 'final'])->name('tiket.final');

    Route::get('/tiket/upload-bukti/{id}', [TiketController::class, 'formUploadBukti'])->name('tiket.upload.form');
    Route::post('/tiket/upload-bukti/{id}', [TiketController::class, 'confirmPayment'])->name('tiket.upload.kirim');

    Route::post('/tiket/{id}/bayar-dummy', [TiketController::class, 'dummyBayar'])->name('tiket.bayar.dummy');

    Route::get('/my-tickets', [TiketController::class, 'myTickets'])->name('tiket.my');

    // Dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();
        $totalTiket = \App\Models\Tiket::where('email', $user->email)->count();
        return view('dashboard', compact('user', 'totalTiket'));
    })->name('dashboard');

    // Profil
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::get('/profil/tiket', [TiketController::class, 'myTickets'])->name('profil.tiket');

    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ganti password
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});

// =======================
// Admin Area
// =======================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/events', [AdminController::class, 'index'])->name('admin.events');
    Route::post('/events', [AdminController::class, 'store'])->name('admin.events.store');
    Route::delete('/events/{event}', [AdminController::class, 'destroy'])->name('admin.events.destroy');

    // CRUD Tiket & Kategori Tiket
    Route::resource('/tiket', AdminTiketController::class);
    Route::resource('/kategori', KategoriTiketController::class);

    // Verifikasi Tiket
    Route::get('/verifikasi-tiket', [AdminTiketController::class, 'daftarVerifikasi'])->name('admin.tiket.verifikasi');
    Route::post('/verifikasi-tiket/{id}/konfirmasi', [AdminTiketController::class, 'adminKonfirmasi'])->name('admin.tiket.konfirmasi');
    Route::post('/verifikasi-tiket/{id}/tolak', [AdminTiketController::class, 'tolakVerifikasi'])->name('admin.tiket.tolak');
});

// Tambahan jika kamu menggunakan Laravel Breeze/Fortify
require __DIR__.'/auth.php';
