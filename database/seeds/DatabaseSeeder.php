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
        $this->call(HmRrhhTableSeeder::class);
        $this->call(HmMotherActivityTableSeeder::class);
        $this->call(HmActivitiesTableSeeder::class);
        $this->call(HmSpecialtiesTableSeeder::class);
        $this->call(HmOperatingRoomsTableSeeder::class);
        $this->call(HmContractsTableSeeder::class);
        $this->call(HmMedicalProgrammingTableSeeder::class);
    }
}
