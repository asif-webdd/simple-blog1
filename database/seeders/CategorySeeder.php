<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach (range(1,10) as $index){
            $name = substr($faker->paragraph, 1, 10);
            Category::create([
                'user_id'=> rand(1, 10),
                'cat_name'=> $name,
                'cat_slug'=> slugify($name),
                'status'=> cat_rand_status(),
            ]);
        }

    }

}
