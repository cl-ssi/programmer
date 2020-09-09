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
      // Specialty::Create(['id_specialty'=>'7024999','specialty_name'=>'MEDICINA INTERNA', 'user_id'=>1]);
      // Specialty::Create(['id_specialty'=>'7024999','specialty_name'=>'MEDICINA GENERAL', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020130','specialty_name'=>'PEDIATRÍA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020230','specialty_name'=>'MEDICINA INTERNA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020330','specialty_name'=>'NEONATOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020331','specialty_name'=>'ENFERMEDAD RESPIRATORIA PEDIÁTRICA (BRONCOPULMONAR INFANTIL)', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020332','specialty_name'=>'ENFERMEDAD RESPIRATORIA DE ADULTO (BRONCOPULMONAR)', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7024219','specialty_name'=>'CARDIOLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020500','specialty_name'=>'CARDIOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020501','specialty_name'=>'ENDOCRINOLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020600','specialty_name'=>'ENDOCRINOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020601','specialty_name'=>'GASTROENTEROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020700','specialty_name'=>'GASTROENTEROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020800','specialty_name'=>'GENÉTICA CLÍNICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020801','specialty_name'=>'HEMATO-ONCOLOGÍA INFANTIL', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020900','specialty_name'=>'HEMATOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7020901','specialty_name'=>'NEFROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021000','specialty_name'=>'NEFROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021001','specialty_name'=>'NUTRIÓLOGO PEDIÁTRICO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021100','specialty_name'=>'NUTRIÓLOGO ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021101','specialty_name'=>'REUMATOLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021230','specialty_name'=>'REUMATOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021300','specialty_name'=>'DERMATOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021301','specialty_name'=>'INFECTOLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022000','specialty_name'=>'INFECTOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022001','specialty_name'=>'INMUNOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021531','specialty_name'=>'GERIATRÍA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022132','specialty_name'=>'MEDICINA FÍSICA Y REHABILITACIÓN PEDIÁTRICA (FISIATRÍA PEDIÁTRICA)', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022133','specialty_name'=>'MEDICINA FÍSICA Y REHABILITACIÓN ADULTO (FISIATRÍA ADULTO)', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022134','specialty_name'=>'NEUROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021700','specialty_name'=>'NEUROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021800','specialty_name'=>'ONCOLOGÍA MÉDICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021801','specialty_name'=>'PSIQUIATRÍA PEDIÁTRICA Y DE LA ADOLESCENCIA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021900','specialty_name'=>'PSIQUIATRÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022130','specialty_name'=>'CIRUGÍA PEDIÁTRICA','color'=>'AB2567', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022142','specialty_name'=>'CIRUGÍA GENERAL ADULTO','color'=>'D869C0', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022143','specialty_name'=>'CIRUGÍA DIGESTIVA (ALTA)','color'=>'D869C0', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022144','specialty_name'=>'CIRUGÍA DE CABEZA, CUELLO Y MAXILOFACIAL','color'=>'D869C0', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022135','specialty_name'=>'CIRUGÍA PLÁSTICA Y REPARADORA PEDIÁTRICA','color'=>'D869C0', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022136','specialty_name'=>'CIRUGÍA PLÁSTICA Y REPARADORA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022137','specialty_name'=>'COLOPROCTOLOGÍA (CIRUGIA DIGESTIVA BAJA)', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022700','specialty_name'=>'CIRUGÍA TÓRAX', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022800','specialty_name'=>'CIRUGÍA VASCULAR PERIFÉRICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7022900','specialty_name'=>'NEUROCIRUGÍA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7021701','specialty_name'=>'CIRUGÍA CARDIOVASCULAR', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7023100','specialty_name'=>'ANESTESIOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7023200','specialty_name'=>'OBSTETRICIA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7023201','specialty_name'=>'GINECOLOGÍA PEDIÁTRICA Y DE LA ADOLESCENCIA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7023202','specialty_name'=>'GINECOLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7023203','specialty_name'=>'OFTALMOLOGÍA','color'=>'44C6D8', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7023700','specialty_name'=>'OTORRINOLARINGOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7023701','specialty_name'=>'TRAUMATOLOGÍA Y ORTOPEDIA PEDIÁTRICA','color'=>'A692D8', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7023702','specialty_name'=>'TRAUMATOLOGÍA Y ORTOPEDIA ADULTO','color'=>'D8CE03', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7023703','specialty_name'=>'UROLOGÍA PEDIÁTRICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7024000','specialty_name'=>'UROLOGÍA ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7024001','specialty_name'=>'MEDICINA FAMILIAR DEL NIÑO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7024200','specialty_name'=>'MEDICINA FAMILIAR', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7030500','specialty_name'=>'MEDICINA FAMILIAR ADULTO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7024201','specialty_name'=>'DIABETOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7024202','specialty_name'=>'MEDICINA NUCLEAR (EXCLUYE INFORMES)', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7030501','specialty_name'=>'IMAGENOLOGÍA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7030502','specialty_name'=>'RADIOTERAPIA ONCOLÓGICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7030996','specialty_name'=>'LABORATORIO CLINICO', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7030997','specialty_name'=>'ANATOMÍA PATOLÓGICA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7030998','specialty_name'=>'MEDICINA DE URGENCIA', 'user_id'=>1]);
      Specialty::Create(['id_specialty'=>'7030999','specialty_name'=>'MEDICINA INTENSIVA', 'user_id'=>1]);
    }
}
