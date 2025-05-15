<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Halaman utama
// Default:
Route::get('/', function () {
    return view('index');
});

// Route untuk menampilkan daftar event
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Route untuk menampilkan detail event berdasarkan id
Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');

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
