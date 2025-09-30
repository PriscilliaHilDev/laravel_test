<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'name' => $this->faker->streetName(), // Nom du bien (ex: Rue de la Paix)
            'description' => $this->faker->paragraph(3), // Description en 3 phrases
            'price_per_night' => $this->faker->randomFloat(2, 30, 300), // prix/nuit entre 30 et 300 €
            'image_path' => 'properties/default.png', //Image par défaut (stockée dans storage/app/public/properties)

        ];
    }
}
