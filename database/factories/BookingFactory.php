<?php

namespace Database\Factories;


use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    public function definition(): array
    {
        // Date de début entre demain et 2 mois
        $start = $this->faker->dateTimeBetween('+1 days', '+2 months');
        // Durée du séjour : 1 à 14 jours
        $end = (clone $start)->modify('+' . rand(1, 14) . ' days');

        return [
            'user_id' => User::factory(),       // crée un user si aucun en DB
            'property_id' => Property::factory(), // crée une propriété si aucune en DB
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
        ];
    }
}