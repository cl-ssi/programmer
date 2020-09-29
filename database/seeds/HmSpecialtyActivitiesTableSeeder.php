<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\SpecialtyActivity;

class HmSpecialtyActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>56, 'performance'=>10]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>55, 'performance'=>2]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>21, 'performance'=>2]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>22, 'performance'=>2]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>18, 'performance'=>8]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>2, 'performance'=>2]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>1, 'performance'=>2]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>26]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>20, 'performance'=>2]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>29]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>7, 'performance'=>1]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>4]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>23]);
        SpecialtyActivity::Create(['specialty_id'=>42,'activity_id'=>10, 'performance'=>3]);
    }
}
