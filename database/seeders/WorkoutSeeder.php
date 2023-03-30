<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workouts = Workout::factory(5)->create();

        $workouts->each( function ($workout) {
            $randomExerciseIds = Exercise::inRandomOrder()->limit(3)->pluck('id');
            $workout->exercises()->sync($randomExerciseIds);
        });
    }
}
