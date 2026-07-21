<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {

        $events = Event::all();

        $users = User::where('role','customer')->get();


        foreach(range(1,20) as $i)
        {

            $first = fake()->firstName();

            $last = fake()->lastName();


            Booking::create([


                // USER CONNECTION
                'user_id' => $users->random()->id,


                // BOOKING INFO
                'booking_id' => 'BK-'.rand(1000,9999),


                // EVENT
                'event_id' => $events->random()->id,



                // CUSTOMER
                'first_name' => $first,

                'last_name' => $last,

                'full_name' => $first.' '.$last,

                'email' => fake()->safeEmail(),



                // CONTACT
                'country_code' => '+63',

                'contact' => fake()->numerify('9#########'),



                // SCHEDULE
                'booking_datetime' => Carbon::now()
                    ->addDays(rand(1,30)),


                'end_datetime' => Carbon::now()
                    ->addDays(rand(2,35))
                    ->addHours(3),



                // DETAILS
                'guests' => rand(1,10),


                'room_type' => fake()->randomElement([
                    'Prince',
                    'King',
                    'VIP',
                    'Elite'
                ]),



                // EXTRA
                'notes' => fake()->sentence(),

                'receipt' => null,


                // STATUS
                'status' => fake()->randomElement([
                    'pending',
                    'approved',
                    'completed',
                    'cancelled'
                ]),


            ]);

        }

    }
}