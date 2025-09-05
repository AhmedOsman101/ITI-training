<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', fn() => view('welcome'))->name('home');

Route::view('dashboard', 'dashboard')
  ->middleware(['auth', 'verified'])
  ->name('dashboard');

Route::middleware(['auth'])->group(
  function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::resource('students', StudentController::class);
  }
);

require __DIR__ . '/auth.php';
