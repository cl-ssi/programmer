<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\ActivityType;

class HmActivityTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivityType::Create(['id' => 1,'name' => 'Actividad médica', 'user_id'=>1]);
        ActivityType::Create(['id' => 2,'name' => 'Actividad no médica', 'user_id'=>1]);
    }
}
