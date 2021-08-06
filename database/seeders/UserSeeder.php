<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        User::create([
            'firstName' => $faker->firstName,
            'lastName' => $faker->lastName,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        foreach (range(1, 10) as $index){
            User::create([
                'firstName' => $faker->firstName,
                'lastName' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => Hash::make('123456'),
            ]);
        }

    }
}
