<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\UserMeasurement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(10)->create();

         $admin = User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@admin.com',
         ]);

         UserMeasurement::create([
             'user_id' => $admin->id,
             'weight' => 78.5,
             'body_fat_percentage' => 17.8
         ]);

        UserMeasurement::create([
            'user_id' => $admin->id,
            'weight' => 76.4,
            'body_fat_percentage' => 15.2
        ]);

//        $this->call([
//           UserSeeder::class,
//           WorkoutSeeder::class,
//           UserMeasurementSeeder::class
//        ]);
    }
}
