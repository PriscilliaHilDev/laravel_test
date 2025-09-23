<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Property;

class BookingSeeder extends Seeder 
{
    use WithoutModelEvents;

    
    public function run(): void
    {
        $users = User::all();
        $properties = Property::all();

        Booking::factory(40) // On génère 40 réservations avec Faker (en mémoire)
        ->make() // "make" = créer les objets sans les sauvegarder en base
        ->each(function ($booking) use ($users, $properties) {
            // On attribue un utilisateur existant au hasard
            $booking->user_id = $users->random()->id;

            // On attribue une propriété existante au hasard
            $booking->property_id = $properties->random()->id;

            // On sauvegarde la réservation en base
            $booking->save();
        });

    }
}