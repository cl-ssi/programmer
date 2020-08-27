<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\MotherActivity;

class HmMotherActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MotherActivity::Create(['id' => 1,'description' => 'Pabellón', 'user_id'=>1]);
        MotherActivity::Create(['id' => 2,'description' => 'Consulta Médica', 'user_id'=>1]);
    }
}
