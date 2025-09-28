<?php

use App\Models\Property;
use App\Livewire\PropertyList;
use App\Livewire\BookingManager;
use App\Livewire\PropertyDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::get('/', function () {

    $latest = Property::latest()->take(6)->get();

    if (Auth::check()) {
        // Page d’accueil personnalisée pour utilisateur connecté
        return view('home_user', compact('latest'));
    } else {

        // les 6 derniers biens a afficher
    
        // Page vitrine pour visiteurs
        return view('home_guest', compact('latest'));
    }
})->name('home');

// Routes publiques (accessibles sans login)
Route::get('/biens', PropertyList::class)->name('properties.index');
Route::get('/bien/{property}', PropertyDetail::class)->name('properties.show');

// Routes protégées (auth obligatoire)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/bookings', BookingManager::class)->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

});
