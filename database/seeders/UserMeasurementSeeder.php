<?php

namespace Database\Seeders;

use App\Models\UserMeasurement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserMeasurement::factory(30)->create();
    }
}
