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
        Profession::Create(['id_profession'=>2, 'profession_name'=>'ENFERMERA', 'user_id'=>1]);
        Profession::Create(['id_profession'=>3, 'profession_name'=>'MATRONA', 'user_id'=>1]);
        Profession::Create(['id_profession'=>4, 'profession_name'=>'NUTRICIONISTA', 'user_id'=>1]);
        Profession::Create(['id_profession'=>5, 'profession_name'=>'KINESIOLOGO', 'user_id'=>1]);
        Profession::Create(['id_profession'=>6, 'profession_name'=>'FONOAUDIOLOGO', 'user_id'=>1]);
        Profession::Create(['id_profession'=>7, 'profession_name'=>'PSICOLOGO', 'user_id'=>1]);
        Profession::Create(['id_profession'=>8, 'profession_name'=>'TERAPEUTA_OCUPACIONAL', 'user_id'=>1]);
        Profession::Create(['id_profession'=>9, 'profession_name'=>'ASISTENTE_SOCIAL', 'user_id'=>1]);
        Profession::Create(['id_profession'=>10, 'profession_name'=>'TECNOLOGO_MEDICO', 'user_id'=>1]);
        Profession::Create(['id_profession'=>11, 'profession_name'=>'QUIMICO_FARMACEUTICO', 'user_id'=>1]);
        Profession::Create(['id_profession'=>12, 'profession_name'=>'BIOQUIMICO', 'user_id'=>1]);
    }
}
