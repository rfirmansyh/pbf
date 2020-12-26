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
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'photo' => null,
                'code' => $faker->ean8,
                'description' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
                'writer' => $faker->name($gender = null),
                'publisher' => $faker->name($gender = null),
                'year_published' => $faker->year($max = 'now'),
                'stock' => rand(1, 100),
                'created_at' => $faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta'),
                'updated_at' => null,
                'rak_id' => rand(1,3)
            ];
        }

        DB::table('books')->insert($books);
        $this->command->info("Data Dummy Books berhasil diinsert");
    }
}
