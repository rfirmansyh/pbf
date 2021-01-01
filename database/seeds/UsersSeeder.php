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
        $users[] = [
            'name' => 'Rahmad Firmansyah',
            'photo' => null,
            'email' => 'fsyah7052@gmail.com',
            'password' =>  bcrypt('@Firman123'),
            'phone' => '085748572354',
            'address' => 'Dusun Kantong Desa Kemiri',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => null,
            'role_id' => 1
        ];
        $users[] = [
            'name' => 'Admin Tester',
            'photo' => null,
            'email' => 'admintest@gmail.com',
            'password' =>  bcrypt('123'),
            'phone' => '085748572354',
            'address' => 'Unknown',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => null,
            'role_id' => 1
        ];
        $users[] = [
            'name' => 'Member Tester',
            'photo' => null,
            'email' => 'membertest@gmail.com',
            'password' =>  bcrypt('123'),
            'phone' => '085748572454',
            'address' => 'Unknown',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => null,
            'role_id' => 2
        ];
        DB::table('users')->insert($users);
        $this->command->info("Data Dummy Users berhasil diinsert");
    }
}
