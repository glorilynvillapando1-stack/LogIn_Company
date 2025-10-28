<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// 🏠 Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});

// 🔐 Login page
Route::get('/login', function () {
    return view('login');
})->name('login');

// 🚪 Handle login form submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// 🧍 Register (optional)
Route::post('/register', [AuthController::class, 'register'])->name('register');

// 🧭 Dashboard – only if user is logged in
Route::get('/dashboard', function () {
    if (!session()->has('user')) {
        return redirect()->route('login')
            ->withErrors(['login_error' => 'Please log in first.']);
    }

    return view('dashboard', [
        'user' => session('user'),
        'company' => session('company'),
    ]);
})->name('dashboard');

// 🚪 Logout – must be POST for security
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Product routes
Route::get('/products', function () {
    return view('products.biochips');
})->name('products.biochips');

Route::get('/products/international', function () {
    return view('products.international');
})->name('products.international');

Route::get('/products/local', function () {
    return view('products.local');
})->name('products.local');

Route::get('/biochip', fn() => view('products.biochip'))->name('biochip');
