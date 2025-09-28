<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        // Génère une date de début aléatoire entre sept et déc 2025
        $start = $this->faker->dateTimeBetween('2025-09-01', '2025-12-15');
        
        // Durée du séjour : 1 à 14 jours
        $end = (clone $start)->modify('+' . rand(1, 14) . ' days');

        return [
            'user_id' => User::factory(),        // crée un user si aucun en DB
            'property_id' => Property::factory(), // crée une propriété si aucune en DB
            'start_date' => $start->format('Y-m-d'),
            'end_date'   => $end->format('Y-m-d'),
        ];
    }
}
