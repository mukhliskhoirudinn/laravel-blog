<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
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

        User::factory()->create([
            'name' => 'muklis',
            'email' => 'muklis@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        Category::factory(1000)->create();
    }
}
