<?php

namespace Database\Seeders;

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
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        $this->call([
            sizeUnitSeeder::class,
            kategoriSeeder::class,
            divisionSeeder::class,
            productSeeder::class,
            sizeSeeder::class,
            divisionOutputSeeder::class,
        ]);
    }
}
