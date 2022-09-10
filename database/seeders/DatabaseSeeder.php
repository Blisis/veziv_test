<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'name',
             'email' => 'test@example.com',
             'password' => Hash::make('password'),
             'admin' =>'1'
         ]);

        Appointment::factory()->create([
            'user_id' => 1,
            'date' => (new \DateTime())->format('Y-m-d'),
            'hour' => '15:00:00',
        ]);
    }
}
