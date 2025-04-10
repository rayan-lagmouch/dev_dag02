<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


// Homepage
Route::get('/', function () {
    return view('home');
});

Route::get('/klant-reservering', function () {
    return view('client-reservation');
});

// Route for displaying the guest order page
Route::get('/guest-order', [OrderController::class, 'showGuestOrderForm'])->name('guest.order');
// Route for processing the guest order form (POST request)
Route::post('/guest-order', [OrderController::class, 'processGuestOrder'])->name('guest.processOrder');
Route::get('/order/confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');



// Dashboard (accessible to all authenticated users)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Order routes
Route::middleware(['auth'])->group(function () {
    Route::post('orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
});


// ===========================
// 🧩 Role-Based CRUD Routes
// ===========================

// Member: Manage Reservations
Route::middleware(['auth', 'role:member'])->group(function () {
    Route::resource('reservations', ReservationController::class);
    Route::resource('scores', ScoreController::class);
    Route::resource('orders', OrderController::class);
});

// Employee: Manage Orders
Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::resource('scores', ScoreController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('reservations', ReservationController::class);
});

// Administrator: Manage Scores & Contacts
Route::middleware(['auth', 'role:administrator'])->group(function () {
    Route::resource('scores', ScoreController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('reservations', ReservationController::class);
});


require __DIR__.'/auth.php';
