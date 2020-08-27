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
      Specialty::Create(['id' => 1,'id_n820'=>'7024000','id_sigte'=> NULL,'specialty_name'=>'UROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 2,'id_n820'=>'7024999','id_sigte'=> NULL,'specialty_name'=>'MEDICINA INTERNA', 'user_id'=>1]);
      Specialty::Create(['id' => 3,'id_n820'=>'7030501','id_sigte'=> NULL,'specialty_name'=>'IMAGENOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 4,'id_n820'=>'7020500','id_sigte'=> NULL,'specialty_name'=>'CARDIOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 5,'id_n820'=>'7020230','id_sigte'=> NULL,'specialty_name'=>'MEDICINA INTERNA', 'user_id'=>1]);
      Specialty::Create(['id' => 6,'id_n820'=>'7022000','id_sigte'=> NULL,'specialty_name'=>'INFECTOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 7,'id_n820'=>'7024999','id_sigte'=> NULL,'specialty_name'=>'MEDICINA GENERAL', 'user_id'=>1]);
      Specialty::Create(['id' => 8,'id_n820'=>'7024201','id_sigte'=> NULL,'specialty_name'=>'DIABETOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 9,'id_n820'=>'7022130','id_sigte'=> NULL,'specialty_name'=>'CIRUGÍA PEDIÁTRICA','color'=>'AB2567', 'user_id'=>1]);
      Specialty::Create(['id' => 10,'id_n820'=>'7023202','id_sigte'=> NULL,'specialty_name'=>'GINECOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 11,'id_n820'=>'7023200','id_sigte'=> NULL,'specialty_name'=>'OBSTETRICIA', 'user_id'=>1]);
      Specialty::Create(['id' => 12,'id_n820'=>'7023100','id_sigte'=> NULL,'specialty_name'=>'ANESTESIOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 13,'id_n820'=>'7023702','id_sigte'=> NULL,'specialty_name'=>'TRAUMATOLOGÍA Y ORTOPEDIA ADULTO','color'=>'D8CE03', 'user_id'=>1]);
      Specialty::Create(['id' => 14,'id_n820'=>'7020330','id_sigte'=> NULL,'specialty_name'=>'NEONATOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 15,'id_n820'=>'7023203','id_sigte'=> NULL,'specialty_name'=>'OFTALMOLOGÍA','color'=>'44C6D8', 'user_id'=>1]);
      Specialty::Create(['id' => 16,'id_n820'=>'7022133','id_sigte'=> NULL,'specialty_name'=>'MEDICINA FÍSICA Y REHABILITACIÓN ADULTO (FISIATRÍA ADULTO)', 'user_id'=>1]);
      Specialty::Create(['id' => 17,'id_n820'=>'7020900','id_sigte'=> NULL,'specialty_name'=>'HEMATOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 18,'id_n820'=>'7023700','id_sigte'=> NULL,'specialty_name'=>'OTORRINOLARINGOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 19,'id_n820'=>'7022142','id_sigte'=> NULL,'specialty_name'=>'CIRUGÍA GENERAL ADULTO','color'=>'D869C0', 'user_id'=>1]);
      Specialty::Create(['id' => 20,'id_n820'=>'7020700','id_sigte'=> NULL,'specialty_name'=>'GASTROENTEROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 21,'id_n820'=>'7021300','id_sigte'=> NULL,'specialty_name'=>'DERMATOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 22,'id_n820'=>'7022134','id_sigte'=> NULL,'specialty_name'=>'NEUROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id' => 23,'id_n820'=>'7021230','id_sigte'=> NULL,'specialty_name'=>'REUMATOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 24,'id_n820'=>'7021700','id_sigte'=> NULL,'specialty_name'=>'NEUROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 25,'id_n820'=>'7022900','id_sigte'=> NULL,'specialty_name'=>'NEUROCIRUGÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 26,'id_n820'=>'7021900','id_sigte'=> NULL,'specialty_name'=>'PSIQUIATRÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 27,'id_n820'=>'7021801','id_sigte'=> NULL,'specialty_name'=>'PSIQUIATRÍA PEDIÁTRICA Y DE LA ADOLESCENCIA', 'user_id'=>1]);
      Specialty::Create(['id' => 28,'id_n820'=>'7020332','id_sigte'=> NULL,'specialty_name'=>'ENFERMEDAD RESPIRATORIA DE ADULTO (BRONCOPULMONAR)', 'user_id'=>1]);
      Specialty::Create(['id' => 29,'id_n820'=>'7020600','id_sigte'=> NULL,'specialty_name'=>'ENDOCRINOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 30,'id_n820'=>'7021000','id_sigte'=> NULL,'specialty_name'=>'NEFROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 31,'id_n820'=>'7021800','id_sigte'=> NULL,'specialty_name'=>'ONCOLOGÍA MÉDICA', 'user_id'=>1]);
      Specialty::Create(['id' => 32,'id_n820'=>'7020130','id_sigte'=> NULL,'specialty_name'=>'PEDIATRÍA', 'user_id'=>1]);
      Specialty::Create(['id' => 33,'id_n820'=>'7023701','id_sigte'=> NULL,'specialty_name'=>'TRAUMATOLOGÍA Y ORTOPEDIA PEDIÁTRICA','color'=>'A692D8', 'user_id'=>1]);
      Specialty::Create(['id' => 34,'id_n820'=>'7022136','id_sigte'=> NULL,'specialty_name'=>'CIRUGÍA PLÁSTICA Y REPARADORA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id' => 35,'id_n820'=>'7023703','id_sigte'=> NULL,'specialty_name'=>'UROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id' => 36,'id_n820'=>'7020501','id_sigte'=> NULL,'specialty_name'=>'ENDOCRINOLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id' => 37,'id_n820'=>'7020901','id_sigte'=> NULL,'specialty_name'=>'NEFROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id' => 38,'id_n820'=>'7020331','id_sigte'=> NULL,'specialty_name'=>'ENFERMEDAD RESPIRATORIA PEDIÁTRICA (BRONCOPULMONAR INFANTIL)', 'user_id'=>1]);
      Specialty::Create(['id' => 39,'id_n820'=>'7020601','id_sigte'=> NULL,'specialty_name'=>'GASTROENTEROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id' => 40,'id_n820'=>'7022800','id_sigte'=> NULL,'specialty_name'=>'CIRUGÍA VASCULAR PERIFÉRICA', 'user_id'=>1]);
    }
}
