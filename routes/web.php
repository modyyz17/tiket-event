<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TiketController;

Route::get('/beli-tiket/{event}', [TiketController::class, 'create'])->name('tiket.create');
Route::post('/beli-tiket', [TiketController::class, 'store'])->name('tiket.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/events/konser', [EventController::class, 'konser']);
Route::get('/events/seminar', [EventController::class, 'seminar']);
Route::get('/events/pameran', [EventController::class, 'pameran']);
Route::get('/events/gameshow', [EventController::class, 'gameshow']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Halaman utama
Route::get('/', function () {
    return view('events.home');
});

// Route untuk menampilkan daftar event
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Route untuk menampilkan detail event berdasarkan id
Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');

// Route untuk halaman konser
Route::get('/konser', [EventController::class, 'konser'])->name('konser');

// Route untuk pembelian tiket
Route::middleware('auth')->group(function () {
    Route::post('event/{event}/buy', [TicketController::class, 'buy'])->name('ticket.buy');
});

// Route auth & profile (pengguna biasa)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route admin (dengan middleware tambahan 'admin')
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/events', [AdminController::class, 'index'])->name('admin.events');
    Route::post('admin/events', [AdminController::class, 'store'])->name('admin.events.store');
    Route::delete('admin/events/{event}', [AdminController::class, 'destroy'])->name('admin.events.destroy');
});



// Route auth bawaan Laravel Breeze/Fortify
require __DIR__.'/auth.php';
