<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $books = [];

        for ($i=0; $i < 10; $i++) { 
            $books[] = [
                'title' => $faker->title,
                'photo' => $faker->imageUrl($width = 640, $height = 480, 'cats', true, 'Faker')
            ];
        }
    }
}
