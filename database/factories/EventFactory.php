<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class EventFactory extends Factory
{

    public function definition(): array
    {

        $events = [

            [
                'name' => 'Grand Wedding Reception',
                'category' => 'Wedding',
            ],

            [
                'name' => 'Corporate Business Conference',
                'category' => 'Business',
            ],

            [
                'name' => 'Technology Innovation Summit',
                'category' => 'Technology',
            ],

            [
                'name' => 'Birthday Celebration Party',
                'category' => 'Private Event',
            ],

            [
                'name' => 'IT Skills Training Workshop',
                'category' => 'Education',
            ],

            [
                'name' => 'Product Launch Event',
                'category' => 'Corporate',
            ],

            [
                'name' => 'Music and Entertainment Night',
                'category' => 'Entertainment',
            ],

            [
                'name' => 'Gaming Tournament Championship',
                'category' => 'Gaming',
            ],

            [
                'name' => 'Family Reunion Gathering',
                'category' => 'Private Event',
            ],

            [
                'name' => 'Holiday Celebration Event',
                'category' => 'Celebration',
            ],

        ];



        $event = fake()->randomElement($events);



        $startDate = fake()->dateTimeBetween(
            '+1 week',
            '+8 months'
        );


        $endDate = (clone $startDate)
            ->modify('+'.fake()->numberBetween(2,8).' hours');



        return [

            /*
            |--------------------------------------------------------------------------
            | EVENT INFORMATION
            |--------------------------------------------------------------------------
            */


            'name' => $event['name'],


            'description' => fake()->randomElement([

                'A memorable event experience with premium facilities and services.',

                'Enjoy a professionally organized event with complete amenities.',

                'Perfect venue for gatherings, celebrations, and special occasions.',

                'A modern event experience designed for guests and organizers.',

            ]),




            /*
            |--------------------------------------------------------------------------
            | LOCATION
            |--------------------------------------------------------------------------
            */


            'location' => fake()->randomElement([

                'Tigno Grand Convention Hall',

                'Lingayen Events Center',

                'Dagupan City Convention Center',

                'Pangasinan Grand Ballroom',

                'Urdaneta Events Pavilion',

                'Manila Convention Center',

                'SMX Convention Center Manila',

                'Baguio Event Pavilion',

            ]),





            /*
            |--------------------------------------------------------------------------
            | DATE AND TIME
            |--------------------------------------------------------------------------
            */


            'start_date' => $startDate,


            'end_date' => $endDate,





            /*
            |--------------------------------------------------------------------------
            | EVENT DETAILS
            |--------------------------------------------------------------------------
            */


            'capacity' => fake()->numberBetween(
                50,
                1500
            ),



            'price' => fake()->numberBetween(
                5000,
                100000
            ),




            'status' => fake()->randomElement([

                'upcoming',

                'active',

                'completed',

                'cancelled',

            ]),





            'category' => $event['category'],





            /*
            |--------------------------------------------------------------------------
            | ORGANIZER
            |--------------------------------------------------------------------------
            */


            'organizer' => fake()->randomElement([

                'Tigno Event Management',

                'Premium Events PH',

                'Pangasinan Events Group',

                'Elite Celebration Services',

            ]),





            /*
            |--------------------------------------------------------------------------
            | IMAGE
            |--------------------------------------------------------------------------
            */


            'image' => fake()->randomElement([

                'events/wedding.jpg',

                'events/conference.jpg',

                'events/business.jpg',

                'events/party.jpg',

            ]),


        ];

    }

}