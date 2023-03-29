<?php

namespace Database\Factories;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExerciseSet>
 */
class ExerciseSetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'exercise_id' => fake()->randomElement(Exercise::pluck('id')),
            'weight' => fake()->numberBetween(8, 100),
            'sets' => fake()->numberBetween(1, 4),
            'repetitions' => fake()->numberBetween(1, 12),
        ];
    }
}
