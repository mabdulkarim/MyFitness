<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserMeasurement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->has(UserMeasurement::factory()->count(3))->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
        ]);

        User::factory(50)->has(UserMeasurement::factory()->count(3))->create();
    }
}
