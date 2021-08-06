<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach (range(1, 30) as $index){
            $title = $faker->text('30');
            Post::create([
                'user_id' => rand(1, 10),
                'category_id' => rand(1, 10),
                'title' => $title,
                'slug' => slugify($title),
                'description' => $faker->paragraphs(2, true),
                'image' => 'demo.jpg',
                'status' => cat_rand_status(),
            ]);
        }

    }
}
