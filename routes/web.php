<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\KategoriTiketController;

// Halaman utama
Route::get('/', function () {
    return view('events.home');
});

// Halaman event umum
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');

// Kategori event
Route::get('/events/konser', [EventController::class, 'konser']);
Route::get('/events/seminar', [EventController::class, 'seminar']);
Route::get('/events/pameran', [EventController::class, 'pameran']);
Route::get('/events/gameshow', [EventController::class, 'gameshow']);

// Pembelian tiket
Route::get('/beli-tiket/{event}', [TiketController::class, 'create'])->name('tiket.create');
Route::post('/beli-tiket', [TiketController::class, 'store'])->name('tiket.store');

// Auth - Login & Register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route untuk user biasa (profile)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Beli tiket event
    Route::post('event/{event}/buy', [TicketController::class, 'buy'])->name('ticket.buy');
});

// Route admin (hanya untuk user dengan role admin) 
    Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('events', [AdminController::class, 'index'])->name('admin.events');
    Route::post('events', [AdminController::class, 'store'])->name('admin.events.store');
    Route::delete('events/{event}', [AdminController::class, 'destroy'])->name('admin.events.destroy');

    // CRUD Tiket & Kategori Tiket
    Route::resource('tiket', TiketController::class);
    Route::resource('kategori', KategoriTiketController::class);
});


// Route auth default (jika kamu pakai Laravel Breeze / Fortify)
require __DIR__.'/auth.php';
