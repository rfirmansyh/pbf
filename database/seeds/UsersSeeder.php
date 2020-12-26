<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $users = [];
        for ($i=0; $i < 5; $i++) { 
            $users[] = [
                'name' => $faker->name($gender = null),
                'photo' => null,
                'email' => $faker->freeEmail,
                'password' =>  bcrypt('123123'),
                'phone' => '085748572354',
                'address' => $faker->address,
                'status' => strval(rand(1,2)),
                'created_at' => $faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta'),
                'updated_at' => null,
                'role_id' => rand(1,2)
            ];
        }
        DB::table('users')->insert($users);
        $this->command->info("Data Dummy Users berhasil diinsert");
    }
}
