<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create or update the demo admin user
        User::updateOrCreate(
            ['email' => 'admin@trackfit.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('password123'),
            ]
        );
    }
}