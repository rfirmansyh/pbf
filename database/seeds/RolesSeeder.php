<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $roles = [];
        $roles[] = [
            'name' => 'Administrator',
            'slug' => 'admin',
            'description' => 'Admin bisa CRUD',
            'created_at' => new DateTime(null, new DateTimeZone('Asia/Bangkok')),
            'updated_at' => null
        ];
        $roles[] = [
            'name' => 'Member',
            'slug' => 'member',
            'description' => 'Member hanya bisa melihat',
            'created_at' => new DateTime(null, new DateTimeZone('Asia/Bangkok')),
            'updated_at' => null
        ];
        DB::table('roles')->insert($roles);
        $this->command->info("Data Dummy Roles berhasil diinsert");
    }
}
