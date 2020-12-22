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
        $users[] = [
            'name' => 'Rahmad Firmansyah',
            'photo' => 'photo/profile/default-admin.png',
            'email' => 'fsyah7052@gmail.com',
            'password' =>  bcrypt('123123'),
            'phone' => '085748572354',
            'bio' => 'Saya adalah Administrator Dari Abja',
            'provinsi' => 'JAWA TIMUR',
            'kabupaten' => 'JEMBER',
            'kecamatan' => 'PANTI',
            'kelurahan' => 'KEMIRI',
            'detail_address' => 'JL. Teropong Bintang no.6',
            'status' => '1',
            'created_at' => new DateTime(null, new DateTimeZone('Asia/Bangkok')),
            'updated_at' => null,
            'deleted_at' => null,
            'manager_id' => null,
            'role_id' => '1'
        ];
        $users[] = [
            'name' => 'Febria Erliana',
            'photo' => 'photo/profile/default-mitra.png',
            'email' => 'febi@gmail.com',
            'password' =>  bcrypt('123123'),
            'phone' => '085123456789',
            'bio' => 'Saya adalah Mitra Dari Abja',
            'provinsi' => 'JAWA TIMUR',
            'kabupaten' => 'JEMBER',
            'kecamatan' => 'PANTI',
            'kelurahan' => 'KEMIRI',
            'detail_address' => 'JL. Teropong Bintang no.6',
            'status' => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => null,
            'deleted_at' => null,
            'manager_id' => null,
            'role_id' => '2'
        ];
        $users[] = [
            'name' => 'Nurina',
            'photo' => 'photo/profile/default-mitra.png',
            'email' => 'nuri@gmail.com',
            'password' =>  bcrypt('123123'),
            'phone' => '085123456789',
            'bio' => 'Saya adalah Mitra Dari Abja',
            'provinsi' => 'JAWA TIMUR',
            'kabupaten' => 'JEMBER',
            'kecamatan' => 'PANTI',
            'kelurahan' => 'KEMIRI',
            'detail_address' => 'JL. Teropong Bintang no.6',
            'status' => '1',
            'created_at' => \Carbon\Carbon::now()->addMonth(),
            'updated_at' => null,
            'deleted_at' => null,
            'manager_id' => null,
            'role_id' => '2'
        ];
        $users[] = [
            'name' => 'Suaimin',
            'photo' => 'photo/profile/default-mitra.png',
            'email' => 'suaimin@gmail.com',
            'password' =>  bcrypt('123123'),
            'phone' => '085123456289',
            'bio' => 'Saya adalah Mitra Dari Abja',
            'provinsi' => 'JAWA TIMUR',
            'kabupaten' => 'JEMBER',
            'kecamatan' => 'PANTI',
            'kelurahan' => 'KEMIRI',
            'detail_address' => 'JL. Teropong Bintang no.6',
            'status' => '1',
            'created_at' => \Carbon\Carbon::now()->addMonth(),
            'updated_at' => null,
            'deleted_at' => null,
            'manager_id' => null,
            'role_id' => '2'
        ];
        $users[] = [
            'name' => 'Bambang Gentolet',
            'photo' => 'photo/profile/default-pekerja.png',
            'email' => 'bambang@gmail.com',
            'password' =>  bcrypt('123123'),
            'phone' => '08123456123',
            'bio' => 'Saya adalah Pekerja dari Febria',
            'provinsi' => 'JAWA TIMUR',
            'kabupaten' => 'SITUBONDO',
            'kecamatan' => 'KAPONGAN',
            'kelurahan' => 'KAPONGAN',
            'detail_address' => 'JL. Kapongan no.6',
            'status' => '1',
            'created_at' => new DateTime(null, new DateTimeZone('Asia/Bangkok')),
            'updated_at' => null,
            'deleted_at' => null,
            'manager_id' => '2',
            'role_id' => '3'
        ];
        $users[] = [
            'name' => 'Rozak Supemen',
            'photo' => 'photo/profile/default-pekerja.png',
            'email' => 'rozak@gmail.com',
            'password' =>  bcrypt('123123'),
            'phone' => '08123456123',
            'bio' => 'Saya adalah Pekerja dari Nurina',
            'provinsi' => 'JAWA TIMUR',
            'kabupaten' => 'SITUBONDO',
            'kecamatan' => 'KAPONGAN',
            'kelurahan' => 'KAPONGAN',
            'detail_address' => 'JL. Kapongan no.6',
            'status' => '1',
            'created_at' => new DateTime(null, new DateTimeZone('Asia/Bangkok')),
            'updated_at' => null,
            'deleted_at' => null,
            'manager_id' => '3',
            'role_id' => '3'
        ];
        DB::table('users')->insert($users);
        $this->command->info("Data Dummy Users berhasil diinsert");
    }
}
