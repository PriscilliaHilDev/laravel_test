<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{

    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Créer un utilisateur admin
        User::factory()->create([
            'name' => 'Admin Seed',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Créer d’autres utilisateurs
        User::factory(9)->create();
    }
}
