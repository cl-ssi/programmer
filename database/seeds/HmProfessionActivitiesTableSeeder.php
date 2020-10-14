<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\ProfessionActivity;

class HmProfessionActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpecialtyActivity::Create(['profession_id'=>1,'activity_id'=>141, 'performance'=>3]);
        SpecialtyActivity::Create(['profession_id'=>1,'activity_id'=>143, 'performance'=>3]);
        SpecialtyActivity::Create(['profession_id'=>1,'activity_id'=>67]);
        SpecialtyActivity::Create(['profession_id'=>1,'activity_id'=>114]);
        SpecialtyActivity::Create(['profession_id'=>1,'activity_id'=>76, 'performance'=>2]);
        SpecialtyActivity::Create(['profession_id'=>1,'activity_id'=>70]);
    }
}
