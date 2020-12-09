<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\Rrhh;

class HmRrhhTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Rrhh::Create(['rut' => 44202611,'dv' => '4','name'=>'LEIDY JOHANA','fathers_family'=>'MOLINA','mothers_family'=>'PRIETO','job_title'=>'MEDICO CIRUJANO/A']);
    }
}
