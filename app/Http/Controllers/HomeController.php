<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $latest = Property::latest()->take(6)->get();

        if (Auth::check()) {
            // Page d’accueil personnalisée pour utilisateur connecté
            return view('home_user', compact('latest'));
        }

        // Page vitrine pour visiteurs
        return view('home_guest', compact('latest'));
    }
}
