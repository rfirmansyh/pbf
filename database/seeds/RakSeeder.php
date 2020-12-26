<?php

use Illuminate\Database\Seeder;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $raks = [];
        for ($i=1; $i <= 3; $i++) { 
            $raks[] = [
                'name' => "Rak A$i",
                'photo' => null,
                'location' => 'Gedung Perpus 1',
                'created_at' => $faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta'),
                'updated_at' => null,
            ];
        }
        DB::table('raks')->insert($raks);
        $this->command->info("Data Dummy Raks berhasil diinsert");
    }
}
