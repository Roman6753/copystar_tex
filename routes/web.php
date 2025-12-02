<?php

use App\Livewire\Register\Register;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
     return view('home');
})->name('home');

Route::get('/register', Register::class)->name('register');

Route::prefix('dashboard')->group(function () {
    Route::view('/', 'dashboard.index')->name('dashboard');
    Route::view('/category', 'dashboard.category')->name('dashboard.category');
    Route::view('/country', 'dashboard.country')->name('dashboard.country');
    Route::view('/user', 'dashboard.user')->name('dashboard.user');
    Route::view('/product', 'dashboard.product')->name('dashboard.product');
});


