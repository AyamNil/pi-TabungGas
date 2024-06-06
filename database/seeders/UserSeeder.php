<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create one admin user
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'phone_number' => $faker->phoneNumber,
            'address' => $faker->address,
            'password' => Hash::make('12345678'), // Change this to a secure password
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create 50 regular users
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'password' => Hash::make('password'), // Change this to a secure password
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
        }

        // Create the specific user
        User::create([
            'name' => $faker->name,
            'email' => 'user@gmail.com',
            'phone_number' => $faker->phoneNumber,
            'address' => $faker->address,
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}
