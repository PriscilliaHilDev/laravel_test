<?php

use App\Models\Property;
use App\Livewire\PropertyList;
use App\Livewire\BookingManager;
use App\Livewire\PropertyDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Routes publiques (accessibles sans login)
Route::get('/biens', PropertyList::class)->name('properties.index');
Route::get('/bien/{property}', PropertyDetail::class)->name('properties.show');

// Routes protégées (auth obligatoire)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
Route::get('/mes-reservations', BookingManager::class)
    ->name('user.bookings');

});
