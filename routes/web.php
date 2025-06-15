<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\PasswordController;

Route::post('/tiket/upload/{id}', [TiketController::class, 'uploadPaymentProof'])->name('tiket.upload.proses');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/tiket', [AdminTiketController::class, 'index']);
});

// Halaman daftar semua tiket
Route::get('/admin/tiket', [TiketController::class, 'listAll'])->name('admin.tiket');

// Admin konfirmasi tiket
Route::post('/admin/tiket/{id}/konfirmasi', [TiketController::class, 'konfirmasi'])->name('admin.tiket.konfirmasi');


Route::post('/upload-bukti/{id}', [TiketController::class, 'uploadBukti'])->name('tiket.uploadBukti');

Route::get('/tiket/{id}/upload', [TiketController::class, 'uploadForm'])->name('tiket.upload.form');
Route::post('/tiket/{id}/upload', [TiketController::class, 'uploadProses'])->name('tiket.upload.proses');


Route::middleware('auth')->group(function () {
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});
Route::post('/event/buy', [TiketController::class, 'store'])->name('tiket.store');
Route::get('/tiket/{id}/final', [TiketController::class, 'final'])->name('tiket.final');
Route::post('/tiket/{id}/confirm-payment', [TiketController::class, 'confirmPayment'])->name('tiket.confirm_payment');

Route::get('/tiket/upload-bukti/{id}', [TiketController::class, 'formUploadBukti'])->name('tiket.upload.form');
Route::post('/tiket/upload-bukti/{id}', [TiketController::class, 'confirmPayment'])->name('tiket.upload.kirim');
Route::get('/tiket/{id}/upload', [TiketController::class, 'uploadForm'])->name('tiket.upload.form');

Route::get('/admin/tiket/verifikasi', [TiketController::class, 'daftarVerifikasi'])->name('admin.tiket.verifikasi');
Route::post('/admin/tiket/tolak/{id}', [TiketController::class, 'tolakVerifikasi'])->name('admin.tiket.tolak');

Route::get('/profil', [UserController::class, 'profil'])->name('profil'); // Pastikan ini ada

Route::get('/profil/tiket', [TiketController::class, 'myTickets'])->name('profil.tiket');

// =======================
// Halaman Utama
// =======================
Route::get('/', function () {
    return view('events.home');
});

// =======================
// Autentikasi (Guest Only)
// =======================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// =======================
// Logout (Authenticated Only)
// =======================
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// =======================
// Dashboard (User)
// =======================
Route::get('/dashboard', function () {
    $user = Auth::user();
    $totalTiket = \App\Models\Tiket::where('email', $user->email)->count();
    return view('dashboard', compact('user', 'totalTiket'));
})->middleware('auth')->name('dashboard');

// =======================
// Event Routes
// =======================
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');

// Kategori Event
Route::get('/events/konser', [EventController::class, 'konser'])->name('konser');
Route::get('/events/seminar', [EventController::class, 'seminar'])->name('seminar');
Route::get('/events/pameran', [EventController::class, 'pameran'])->name('pameran');
Route::get('/events/gameshow', [EventController::class, 'gameshow'])->name('gameshow');


// =======================
// Tiket Routes
// =======================
// Pembelian tiket
Route::get('/event/{id}/buy', [TiketController::class, 'create'])->name('tiket.create');
Route::post('/event/buy', [TiketController::class, 'store'])->name('tiket.store');
Route::get('/tiket/{id}/success', [TiketController::class, 'success'])->name('tiket.success');
Route::get('/my-tickets', [TiketController::class, 'myTickets'])->name('tiket.my');
Route::post('/tiket/{id}/bayar-dummy', [TiketController::class, 'dummyBayar'])->name('ticket.bayar.dummy');

// Tiket success & QR Code
Route::get('/tiket/success/{id}', [TiketController::class, 'success'])->name('tiket.success');

// Dummy Bayar
Route::post('/ticket/{id}/bayar', [TiketController::class, 'dummyBayar'])->name('ticket.bayar.dummy');

// Tiket milik user
Route::middleware('auth')->group(function () {
    Route::get('/my-tickets', [TiketController::class, 'myTickets'])->name('tiket.my');
});

// =======================
// Admin Area
// =======================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/tiket', [TiketController::class, 'listAll'])->name('admin.tiket');
    Route::post('/admin/tiket/{id}/konfirmasi', [TiketController::class, 'konfirmasi'])->name('admin.tiket.konfirmasi');

    Route::get('/admin/events', [AdminController::class, 'index'])->name('admin.events');
    Route::post('/admin/events', [AdminController::class, 'store'])->name('admin.events.store');
    Route::delete('/admin/events/{event}', [AdminController::class, 'destroy'])->name('admin.events.destroy');
});

// Halaman daftar tiket menunggu verifikasi
Route::get('/admin/verifikasi-pembayaran', [AdminController::class, 'verifikasiPembayaran'])->name('admin.verifikasi.pembayaran');

// Aksi konfirmasi pembayaran oleh admin
Route::post('/admin/konfirmasi/{id}', [AdminController::class, 'konfirmasiPembayaran'])->name('admin.konfirmasi.pembayaran');

// =======================
// Profile User
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/tiket', [AdminTiketController::class, 'index'])->name('admin.tiket.index');
    Route::get('/tiket/{id}', [AdminTiketController::class, 'show'])->name('admin.tiket.show');
    Route::post('/tiket/{id}/update', [AdminTiketController::class, 'updateStatus'])->name('admin.tiket.update');
});