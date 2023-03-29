<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserMeasurement>
 */
class UserMeasurementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->randomElement(User::pluck('id')),
            'weight' => fake()->numberBetween(45, 150),
            'body_fat_percentage' => fake()->numberBetween(10, 40),
        ];
    }
}
