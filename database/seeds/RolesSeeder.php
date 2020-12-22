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
            'description' => 'Admin Merupakan User yang dapat Memanage semua akses aplikasi, tetapi tidak termasuk Privasi User/Mitra',
            'created_at' => new DateTime(null, new DateTimeZone('Asia/Bangkok')),
            'updated_at' => null
        ];
        $roles[] = [
            'name' => 'Mitra',
            'slug' => 'mitra',
            'description' => 'Mitra Merupakan User yang ditujukan untuk memanfaatkan Kemudahan aplikasi ABJA',
            'created_at' => new DateTime(null, new DateTimeZone('Asia/Bangkok')),
            'updated_at' => null
        ];
        $roles[] = [
            'name' => 'Pekerja',
            'slug' => 'pekerja',
            'description' => 'Pekerja Merupakan User yang Membantu Mitra Mengembangkan Budidayanya',
            'created_at' => new DateTime(null, new DateTimeZone('Asia/Bangkok')),
            'updated_at' => null
        ];
        DB::table('roles')->insert($roles);
        $this->command->info("Data Dummy Roles berhasil diinsert");
    }
}
