<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        // CREATE ADMIN
        User::create([

            'name' => 'Admin',

            'email' => 'admin@tigno.com',

            'password' => Hash::make('password'),

            'role' => 'admin',

        ]);



        // CREATE CUSTOMERS
        User::factory(10)->create([

            'role' => 'customer',

        ]);



        // EVENTS
        $this->call([

            EventSeeder::class,

            BookingSeeder::class,

        ]);

    }
}