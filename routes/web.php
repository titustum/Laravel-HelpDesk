<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Volt::route('admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Volt::route('admin/problem/create', 'admin.create-problem')->name('admin.problems.create');

    Volt::route('admin/problems', 'admin.problems')->name('admin.problems.index');
    Volt::route('admin/problems/{id}', 'admin.show-problem')->name('admin.problems.show');
    Volt::route('admin/problems/edit/{id}', 'admin.edit-problem')->name('admin.problems.edit');

    Volt::route('admin/officers', 'admin.officers')->name('admin.officers.index');
    Volt::route('admin/reports', 'admin.reports')->name('admin.reports');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

require __DIR__.'/auth.php';
