<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\Activity;

class HmActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Activity::Create(['id' => 1,'mother_activity_id' => 2,'activity_name'=>'Consulta Nueva de especialidad', 'user_id'=>1]);
      Activity::Create(['id' => 2,'mother_activity_id' => 2,'activity_name'=>'Consulta Control de especialidad', 'user_id'=>1]);
      Activity::Create(['id' => 3,'mother_activity_id' => 2,'activity_name'=>'Atención de Servicio de Urgencia (Desde Atención Ambulatoria).', 'user_id'=>1]);
      Activity::Create(['id' => 4,'mother_activity_id' => 2,'activity_name'=>'Procedimientos especialidad', 'user_id'=>1]);
      Activity::Create(['id' => 5,'mother_activity_id' => NULL,'activity_name'=>'Turno (Todas las unidades hospitalarias)', 'user_id'=>1]);
      Activity::Create(['id' => 6,'mother_activity_id' => 1,'activity_name'=>'Pabellon Cirugía Mayor Ambulatoria', 'user_id'=>1]);
      Activity::Create(['id' => 7,'mother_activity_id' => 1,'activity_name'=>'Pabellon Cirugía Mayor', 'user_id'=>1]);
      Activity::Create(['id' => 8,'mother_activity_id' => 1,'activity_name'=>'Pabellon Cirugía Menor', 'user_id'=>1]);
      Activity::Create(['id' => 9,'mother_activity_id' => 1,'activity_name'=>'Pabellon Cirugía Obstetrica', 'user_id'=>1]);
      Activity::Create(['id' => 10,'mother_activity_id' => 2,'activity_name'=>'Visita a sala Hospitalizado', 'user_id'=>1]);
      Activity::Create(['id' => 11,'mother_activity_id' => 2,'activity_name'=>'Consultoría en salud', 'user_id'=>1]);
      Activity::Create(['id' => 12,'mother_activity_id' => 2,'activity_name'=>'Ronda otro establecimiento', 'user_id'=>1]);
      Activity::Create(['id' => 13,'mother_activity_id' => 2,'activity_name'=>'Teleconsulta nueva de especialidad', 'user_id'=>1]);
      Activity::Create(['id' => 14,'mother_activity_id' => 2,'activity_name'=>'Teleconsulta control de especialidad', 'user_id'=>1]);
      Activity::Create(['id' => 15,'mother_activity_id' => 2,'activity_name'=>'Teleconsulta de especialidad hospitalizado', 'user_id'=>1]);
      Activity::Create(['id' => 16,'mother_activity_id' => 2,'activity_name'=>'Visita Domiciliaria', 'user_id'=>1]);
      Activity::Create(['id' => 17,'mother_activity_id' => 2,'activity_name'=>'Gestión de Casos', 'user_id'=>1]);
      Activity::Create(['id' => 18,'mother_activity_id' => 2,'activity_name'=>'Consulta Abreviada Médica', 'user_id'=>1]);
      Activity::Create(['id' => 19,'mother_activity_id' => 2,'activity_name'=>'Procedimientos Imagenológicos (Médico)', 'user_id'=>1]);
      Activity::Create(['id' => 20,'mother_activity_id' => 2,'activity_name'=>'Interconsulta en sala', 'user_id'=>1]);
      Activity::Create(['id' => 21,'mother_activity_id' => 2,'activity_name'=>'Comité Clínico', 'user_id'=>1]);
      Activity::Create(['id' => 22,'mother_activity_id' => 2,'activity_name'=>'Comité Oncológico', 'user_id'=>1]);
      Activity::Create(['id' => 23,'mother_activity_id' => 2,'activity_name'=>'Reunión Clínica', 'user_id'=>1]);
      Activity::Create(['id' => 24,'mother_activity_id' => 2,'activity_name'=>'Reunión Técnica Administrativa', 'user_id'=>1]);
      Activity::Create(['id' => 25,'mother_activity_id' => 2,'activity_name'=>'Otros Actividades Clínicas', 'user_id'=>1]);
      Activity::Create(['id' => 26,'mother_activity_id' => 2,'activity_name'=>'Gestión Organizacional (Administrativo/ Jefatura)', 'user_id'=>1]);
      Activity::Create(['id' => 27,'mother_activity_id' => 2,'activity_name'=>'Investigación', 'user_id'=>1]);
      Activity::Create(['id' => 28,'mother_activity_id' => 2,'activity_name'=>'Docencia', 'user_id'=>1]);
      Activity::Create(['id' => 29,'mother_activity_id' => 2,'activity_name'=>'Otras Actividades No Clínicas', 'user_id'=>1]);
      Activity::Create(['id' => 30,'mother_activity_id' => 2,'activity_name'=>'Hospitalización Domiciliaria', 'user_id'=>1]);
      Activity::Create(['id' => 31,'mother_activity_id' => 2,'activity_name'=>'Comite Articulador de Continuidad de Cuidados (SM/ REHAB)', 'user_id'=>1]);
      Activity::Create(['id' => 32,'mother_activity_id' => 2,'activity_name'=>'Psicoterapia Grupal (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 33,'mother_activity_id' => 2,'activity_name'=>'Psicoterapia Familiar (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 34,'mother_activity_id' => 2,'activity_name'=>'Intervención Psicosocial Grupal (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 35,'mother_activity_id' => 2,'activity_name'=>'Rescate no presencial (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 36,'mother_activity_id' => 2,'activity_name'=>'Visita Integral de Salud Mental (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 37,'mother_activity_id' => 2,'activity_name'=>'Actividad Comunitaria (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 38,'mother_activity_id' => 2,'activity_name'=>'Actividades con organizaciones de usuarios y familiares (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 39,'mother_activity_id' => 2,'activity_name'=>'Colaboración y formación con grupos de autoayuda (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 40,'mother_activity_id' => 2,'activity_name'=>'Coordinación con Equipos de la red de salud (PCI/ SM)', 'user_id'=>1]);
      Activity::Create(['id' => 41,'mother_activity_id' => 2,'activity_name'=>'Trabajo sectorial (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 42,'mother_activity_id' => 2,'activity_name'=>'Trabajo intersectorial (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 43,'mother_activity_id' => 2,'activity_name'=>'Actividades de cuidado del equipo (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 44,'mother_activity_id' => 2,'activity_name'=>'Comité de ingreso a atención cerrada (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 45,'mother_activity_id' => 2,'activity_name'=>'Consejo Técnico de Salud Mental en el Servicio de Salud (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 91,'mother_activity_id' => 2,'activity_name'=>'Comité por Telemedicina', 'user_id'=>1]);
      Activity::Create(['id' => 92,'mother_activity_id' => 2,'activity_name'=>'Consulta Ingreso Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 93,'mother_activity_id' => 2,'activity_name'=>'Consulta Control Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 94,'mother_activity_id' => 2,'activity_name'=>'Intervención Familiar Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 95,'mother_activity_id' => 2,'activity_name'=>'Intervención Psicosocial Grupal Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
      Activity::Create(['id' => 96,'mother_activity_id' => 2,'activity_name'=>'Visita Integral de Salud Mental Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
    }
}
