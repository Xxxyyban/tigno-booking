<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'booking_id' => 'BK-' . fake()->unique()->numberBetween(1000, 9999),
            'full_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'contact' => fake()->phoneNumber(),
            'booking_datetime' => now(),
            'guests' => fake()->numberBetween(1, 5),
            'notes' => fake()->sentence(),
            'receipt' => null,
        ];
    }
}