<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Public Views
Route::view('/', 'welcome');
Route::view('/home', 'home')->name('home');
Route::view('/feedback', 'feedback')->name('feedback');

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    // Admin-Specific Routes
    Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // User Management
        Route::get('/store-user', [AdminController::class, 'showAddUserForm'])->name('addUser');
        Route::post('/store-user', [AdminController::class, 'storeUser'])->name('storeUser');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');

        // Payment Handling
        Route::get('/paymentform/{id}', [AuthController::class, 'paymentform'])->name('paymentform');

        Route::put('/paymentform/{id}', [AuthController::class, 'updatePayment'])->name('updatePayment');

        Route::post('/subscription/{id}', [AdminController::class, 'handleSubscription'])->name('subscription.handle');

        Route::get('/payment-history/{userId}', [AdminController::class, 'paymentHistory'])->name('paymentHistory');
    });
});
