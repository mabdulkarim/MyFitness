<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\ExerciseSet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exercise::factory(20)->has(ExerciseSet::factory()->count(1))->create();
    }
}
