<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignRoleToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh User SuperAdmin
        $user = User::firstOrCreate(
            ['email' => 'superadmin@example.com'], // Ganti dengan email yang sesuai
            [
                'name' => 'SuperAdmin',
                'password' => bcrypt('password'), // Ganti password sesuai kebutuhan
            ]
        );
        $user->assignRole('SuperAdmin');

        // Contoh User Guest
        $guest = User::firstOrCreate(
            ['email' => 'guest@example.com'],
            [
                'name' => 'Guest User',
                'password' => bcrypt('password'),
            ]
        );
        $guest->assignRole('Guest');
    }
}
