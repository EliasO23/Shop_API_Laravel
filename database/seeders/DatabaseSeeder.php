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
        
         /*
         * Create 50 users, each with 1 to 5 orders
         */
         Users::factory(50)->create()->each(function ($users) {
            Orders::factory(rand(1, 5))->create([
                'user_id' => $users->id,
            ]);
        });
        
    }
}
