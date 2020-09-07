<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\Specialty;

class HmSpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Specialty::Create(['id' => 1,'id_specialty'=>'7024000','specialty_name'=>'UROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 2,'id_specialty'=>'7024999','specialty_name'=>'MEDICINA INTERNA', 'user_id'=>1]);
      Specialty::Create(['id' => 3,'id_specialty'=>'7030501','specialty_name'=>'IMAGENOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 4,'id_specialty'=>'7020500','specialty_name'=>'CARDIOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 5,'id_specialty'=>'7020230','specialty_name'=>'MEDICINA INTERNA', 'user_id'=>1]);
      Specialty::Create(['id' => 6,'id_specialty'=>'7022000','specialty_name'=>'INFECTOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 7,'id_specialty'=>'7024999','specialty_name'=>'MEDICINA GENERAL', 'user_id'=>1]);
      Specialty::Create(['id' => 8,'id_specialty'=>'7024201','specialty_name'=>'DIABETOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 9,'id_specialty'=>'7022130','specialty_name'=>'CIRUGÍA PEDIÁTRICA','color'=>'AB2567', 'user_id'=>1]);
      Specialty::Create(['id' => 10,'id_specialty'=>'7023202','specialty_name'=>'GINECOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 11,'id_specialty'=>'7023200','specialty_name'=>'OBSTETRICIA', 'user_id'=>1]);
      Specialty::Create(['id' => 12,'id_specialty'=>'7023100','specialty_name'=>'ANESTESIOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 13,'id_specialty'=>'7023702','specialty_name'=>'TRAUMATOLOGÍA Y ORTOPEDIA ADULTO','color'=>'D8CE03', 'user_id'=>1]);
      Specialty::Create(['id' => 14,'id_specialty'=>'7020330','specialty_name'=>'NEONATOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 15,'id_specialty'=>'7023203','specialty_name'=>'OFTALMOLOGÍA','color'=>'44C6D8', 'user_id'=>1]);
      Specialty::Create(['id' => 16,'id_specialty'=>'7022133','specialty_name'=>'MEDICINA FÍSICA Y REHABILITACIÓN ADULTO (FISIATRÍA ADULTO)', 'user_id'=>1]);
      Specialty::Create(['id' => 17,'id_specialty'=>'7020900','specialty_name'=>'HEMATOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 18,'id_specialty'=>'7023700','specialty_name'=>'OTORRINOLARINGOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 19,'id_specialty'=>'7022142','specialty_name'=>'CIRUGÍA GENERAL ADULTO','color'=>'D869C0', 'user_id'=>1]);
      Specialty::Create(['id' => 20,'id_specialty'=>'7020700','specialty_name'=>'GASTROENTEROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 21,'id_specialty'=>'7021300','specialty_name'=>'DERMATOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 22,'id_specialty'=>'7022134','specialty_name'=>'NEUROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id' => 23,'id_specialty'=>'7021230','specialty_name'=>'REUMATOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 24,'id_specialty'=>'7021700','specialty_name'=>'NEUROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 25,'id_specialty'=>'7022900','specialty_name'=>'NEUROCIRUGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 26,'id_specialty'=>'7021900','specialty_name'=>'PSIQUIATRÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 27,'id_specialty'=>'7021801','specialty_name'=>'PSIQUIATRÍA PEDIÁTRICA Y DE LA ADOLESCENCIA', 'user_id'=>1]);
      Specialty::Create(['id' => 28,'id_specialty'=>'7020332','specialty_name'=>'ENFERMEDAD RESPIRATORIA DE ADULTO (BRONCOPULMONAR)', 'user_id'=>1]);
      Specialty::Create(['id' => 29,'id_specialty'=>'7020600','specialty_name'=>'ENDOCRINOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 30,'id_specialty'=>'7021000','specialty_name'=>'NEFROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 31,'id_specialty'=>'7021800','specialty_name'=>'ONCOLOGÍA MÉDICA', 'user_id'=>1]);
      Specialty::Create(['id' => 32,'id_specialty'=>'7020130','specialty_name'=>'PEDIATRÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 33,'id_specialty'=>'7023701','specialty_name'=>'TRAUMATOLOGÍA Y ORTOPEDIA PEDIÁTRICA','color'=>'A692D8', 'user_id'=>1]);
      Specialty::Create(['id' => 34,'id_specialty'=>'7022136','specialty_name'=>'CIRUGÍA PLÁSTICA Y REPARADORA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 35,'id_specialty'=>'7023703','specialty_name'=>'UROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id' => 36,'id_specialty'=>'7020501','specialty_name'=>'ENDOCRINOLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id' => 37,'id_specialty'=>'7020901','specialty_name'=>'NEFROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id' => 38,'id_specialty'=>'7020331','specialty_name'=>'ENFERMEDAD RESPIRATORIA PEDIÁTRICA (BRONCOPULMONAR INFANTIL)', 'user_id'=>1]);
      Specialty::Create(['id' => 39,'id_specialty'=>'7020601','specialty_name'=>'GASTROENTEROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id' => 40,'id_specialty'=>'7022800','specialty_name'=>'CIRUGÍA VASCULAR PERIFÉRICA', 'user_id'=>1]);
    }
}
