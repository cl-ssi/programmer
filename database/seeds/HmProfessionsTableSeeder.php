<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\Profession;

class HmProfessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profession::Create(['id_profession'=>2, 'profession_name'=>'ENFERMERA']);
        Profession::Create(['id_profession'=>3, 'profession_name'=>'MATRONA']);
        Profession::Create(['id_profession'=>4, 'profession_name'=>'NUTRICIONISTA']);
        Profession::Create(['id_profession'=>5, 'profession_name'=>'KINESIOLOGO']);
        Profession::Create(['id_profession'=>6, 'profession_name'=>'FONOAUDIOLOGO']);
        Profession::Create(['id_profession'=>7, 'profession_name'=>'PSICOLOGO']);
        Profession::Create(['id_profession'=>8, 'profession_name'=>'TERAPEUTA_OCUPACIONAL']);
        Profession::Create(['id_profession'=>9, 'profession_name'=>'ASISTENTE_SOCIAL']);
        Profession::Create(['id_profession'=>10, 'profession_name'=>'TECNOLOGO_MEDICO']);
        Profession::Create(['id_profession'=>11, 'profession_name'=>'QUIMICO_FARMACEUTICO']);
        Profession::Create(['id_profession'=>12, 'profession_name'=>'BIOQUIMICO']);
    }
}
