<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\User;

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');


Route::get('users', function(){
    return User::select(['name', 'email', 'role'])->inRandomOrder()->limit(6)->get();
})->name('users');




//client
Route::middleware(['auth', 'role:client'])->group(function () {
    Volt::route('dashboard', 'client.dashboard')->name('client.dashboard');
    Volt::route('client/dashboard', 'client.dashboard')->name('client.dashboard');
    Volt::route('client/problems', 'client.problems')->name('client.problems');
    Volt::route('client/problem/create', 'client.create-problem')->name('client.problems.create');
    Volt::route('client/problems/{id}', 'client.show-problem')->name('client.problems.show');
});

//officer
Route::middleware(['auth', 'role:officer'])->group(function () {
    Volt::route('dashboard', 'officer.dashboard')->name('officer.dashboard');
    Volt::route('officer/dashboard', 'officer.dashboard')->name('officer.dashboard');
    Volt::route('officer/problems', 'officer.problems')->name('officer.problems');
    Volt::route('officer/problems/{id}', 'officer.show-problem')->name('officer.problems.show');
});

//admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Volt::route('admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Volt::route('admin/problem/create', 'admin.create-problem')->name('admin.problems.create');

    Volt::route('admin/problems', 'admin.problems')->name('admin.problems.index');
    Volt::route('admin/problems/{id}', 'admin.show-problem')->name('admin.problems.show');
    Volt::route('admin/problems/edit/{id}', 'admin.edit-problem')->name('admin.problems.edit');

    Volt::route('admin/officers', 'admin.officers')->name('admin.officers.index');
    Volt::route('admin/reports', 'admin.reports')->name('admin.reports');


});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::view('profile', 'profile')->name('profile');
});



require __DIR__.'/auth.php';
