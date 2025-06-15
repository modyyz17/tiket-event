<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminTiketController;

// =======================
// Halaman Utama
// =======================
Route::get('/', fn () => view('events.home'))->name('home');

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
// Logout
// =======================
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// =======================
// Dashboard User
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
// Beli tiket
Route::get('/event/{id}/buy', [TiketController::class, 'create'])->name('tiket.create');
Route::post('/event/buy', [TiketController::class, 'store'])->name('tiket.store');
Route::post('/tiket/{id}/konfirmasi', [TiketController::class, 'confirmPayment'])->name('tiket.confirm_payment');
// Tiket selesai beli
Route::get('/tiket/{id}/success', [TiketController::class, 'success'])->name('tiket.success');
Route::get('/tiket/{id}/final', [TiketController::class, 'final'])->name('tiket.final');

// Upload bukti pembayaran
Route::get('/tiket/upload-bukti/{id}', [TiketController::class, 'formUploadBukti'])->name('tiket.upload.form');
Route::post('/tiket/upload-bukti/{id}', [TiketController::class, 'confirmPayment'])->name('tiket.upload.kirim');

// Tiket user (butuh login)
Route::middleware('auth')->group(function () {
    Route::get('/my-tickets', [TiketController::class, 'myTickets'])->name('tiket.my');
});

// Dummy bayar (testing/dev only)
Route::post('/ticket/{id}/bayar', [TiketController::class, 'dummyBayar'])->name('ticket.bayar.dummy');

// =======================
// Admin Tiket Verifikasi
// =======================
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminTiketController::class, 'index'])->name('admin.dashboard');
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class, [
        'as' => 'admin'
    ]);

    // Daftar tiket yang perlu verifikasi
    Route::get('/admin/verifikasi', [AdminTiketController::class, 'daftarVerifikasi'])->name('admin.tiket.verifikasi');
    Route::get('/admin/verifikasi', [AdminTiketController::class, 'daftarVerifikasi'])->name('admin.verifikasi.index');

    // Detail tiket (show)
    Route::get('/admin/verifikasi/{id}', [AdminTiketController::class, 'show'])->name('admin.tiket.show');

    // Konfirmasi tiket
    Route::post('/admin/verifikasi/{id}/konfirmasi', [AdminTiketController::class, 'konfirmasi'])->name('admin.tiket.konfirmasi');

    // Tolak tiket
    Route::post('/admin/verifikasi/{id}/tolak', [AdminTiketController::class, 'tolakVerifikasi'])->name('admin.tiket.tolak');
});

// =======================
// Profile User
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::get('/profil/tiket', [TiketController::class, 'myTickets'])->name('profil.tiket');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');

    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});
