<?php

namespace Database\Seeders;

use App\Models\Users;
use App\Models\Orders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Users::factory(50)->create();

         // Crear 50 usuarios y, para cada uno, generar entre 1 y 5 órdenes.
         Users::factory(50)->create()->each(function ($users) {
            Orders::factory(rand(1, 5))->create([
                'user_id' => $users->id,
            ]);
        });
        
    }
}
