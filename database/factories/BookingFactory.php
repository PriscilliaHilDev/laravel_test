<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'user_id'     => User::inRandomOrder()->first()?->id,     // prend un user existant
            'property_id' => Property::inRandomOrder()->first()?->id, // prend une property existante

            // Date de début de réservation aléatoire, entre demain et dans 10 jours
            'start_date'  => $this->faker->dateTimeBetween('+1 days', '+10 days'),

            // Date de fin de réservation aléatoire, entre 11 jours et 20 jours à partir d’aujourd’hui
            // → garantit que la fin est toujours après la date de début
            'end_date'    => $this->faker->dateTimeBetween('+11 days', '+20 days'),
        ];
    }
}
