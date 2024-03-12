<?php

use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Patients;
use App\Livewire\Patients\Record;
use App\Livewire\Settings\Settings;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect('login');
});

Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

/* 
*
*   These routes must only be accesible to authenticated and
*   verified user of the application
*
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('profile', 'profile')
        ->name('profile');

    // Livewire components
    Route::get('/dashboard', Dashboard::class)
        ->name('dashboard');
    Route::prefix('patients')->group(function () {
        Route::get('/', Patients::class)
            ->name('patients');
        Route::get('/{id}', Record::class)
            ->name('record');
    });
    Route::get('/settings', Settings::class)
        ->name('settings');
});

// Fallback method

/* Route::fallback(function () {
    // ...
}); */


require __DIR__ . '/auth.php';
