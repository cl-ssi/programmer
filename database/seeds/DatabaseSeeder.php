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
        $this->call(PermissionSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(HmRrhhTableSeeder::class);
        $this->call(HmMotherActivityTableSeeder::class);
        $this->call(HmActivityTypesTableSeeder::class);
        $this->call(HmActivitiesTableSeeder::class);
        $this->call(HmSpecialtiesTableSeeder::class);
        $this->call(HmSpecialtyActivitiesTableSeeder::class);
        $this->call(HmProfessionsTableSeeder::class);
        $this->call(HmOperatingRoomsTableSeeder::class);
        $this->call(HmContractsTableSeeder::class);
        // $this->call(HmMedicalProgrammingTableSeeder::class);
        $this->call(HmUserSpecialtiesTableSeeder::class);
        $this->call(HmUserProfessionsTableSeeder::class);
        $this->call(HmTheoreticalProgrammingTableSeeder::class);
        $this->call(HmOperatingRoomProgrammingTableSeeder::class);
    }
}
