<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call("RolesSeeder");
        $this->call("UsersSeeder");
        $this->call("BudidayasSeeder");
        $this->call("JamurSeeder");
        $this->call("KumbungSeeder");
        $this->call("ProductiontypeSeeder");
        $this->call("ProductionSeeder");
        $this->call("KeuanganSeeder");
        $this->call("PemasukanSeeder");
        $this->call("PengeluaranSeeder");
        $this->call("KebutuhantypeSeeder");
        $this->call("CategorySeeder");
        $this->call("PostSeeder");
    }
}
