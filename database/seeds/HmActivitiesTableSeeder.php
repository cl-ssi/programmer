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
        //actividades médicas
      Activity::Create(['id_activity' => 1,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Consulta Nueva de especialidad', 'user_id'=>1]);
      Activity::Create(['id_activity' => 2,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Consulta Control de especialidad', 'user_id'=>1]);
      Activity::Create(['id_activity' => 3,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Atención de Servicio de Urgencia (Desde Atención Ambulatoria).', 'user_id'=>1]);
      Activity::Create(['id_activity' => 4,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Procedimientos especialidad', 'user_id'=>1]);
      Activity::Create(['id_activity' => 5,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Turno (Todas las unidades hospitalarias)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 6,'mother_activity_id' => 1,'activity_type_id'=>1,'activity_name'=>'Pabellon Cirugía Mayor Ambulatoria', 'user_id'=>1]);
      Activity::Create(['id_activity' => 7,'mother_activity_id' => 1,'activity_type_id'=>1,'activity_name'=>'Pabellon Cirugía Mayor', 'user_id'=>1]);
      Activity::Create(['id_activity' => 8,'mother_activity_id' => 1,'activity_type_id'=>1,'activity_name'=>'Pabellon Cirugía Menor', 'user_id'=>1]);
      Activity::Create(['id_activity' => 9,'mother_activity_id' => 1,'activity_type_id'=>1,'activity_name'=>'Pabellon Cirugía Obstetrica', 'user_id'=>1]);
      Activity::Create(['id_activity' => 10,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Visita a sala Hospitalizado', 'user_id'=>1]);
      Activity::Create(['id_activity' => 11,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Consultoría en salud', 'user_id'=>1]);
      Activity::Create(['id_activity' => 12,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Ronda otro establecimiento', 'user_id'=>1]);
      Activity::Create(['id_activity' => 13,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Teleconsulta nueva de especialidad', 'user_id'=>1]);
      Activity::Create(['id_activity' => 14,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Teleconsulta control de especialidad', 'user_id'=>1]);
      Activity::Create(['id_activity' => 15,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Teleconsulta de especialidad hospitalizado', 'user_id'=>1]);
      Activity::Create(['id_activity' => 16,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Visita Domiciliaria', 'user_id'=>1]);
      Activity::Create(['id_activity' => 17,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Gestión de Casos', 'user_id'=>1]);
      Activity::Create(['id_activity' => 18,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Consulta Abreviada Médica', 'user_id'=>1]);
      Activity::Create(['id_activity' => 19,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Procedimientos Imagenológicos (Médico)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 20,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Interconsulta en sala', 'user_id'=>1]);
      Activity::Create(['id_activity' => 21,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Comité Clínico', 'user_id'=>1]);
      Activity::Create(['id_activity' => 22,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Comité Oncológico', 'user_id'=>1]);
      Activity::Create(['id_activity' => 23,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Reunión Clínica', 'user_id'=>1]);
      Activity::Create(['id_activity' => 24,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Reunión Técnica Administrativa', 'user_id'=>1]);
      Activity::Create(['id_activity' => 25,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Otros Actividades Clínicas', 'user_id'=>1]);
      Activity::Create(['id_activity' => 26,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Gestión Organizacional (Administrativo/ Jefatura)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 27,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Investigación', 'user_id'=>1]);
      Activity::Create(['id_activity' => 28,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Docencia', 'user_id'=>1]);
      Activity::Create(['id_activity' => 29,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Otras Actividades No Clínicas', 'user_id'=>1]);
      Activity::Create(['id_activity' => 30,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Hospitalización Domiciliaria', 'user_id'=>1]);
      Activity::Create(['id_activity' => 31,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Comite Articulador de Continuidad de Cuidados (SM/ REHAB)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 32,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Psicoterapia Grupal (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 33,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Psicoterapia Familiar (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 34,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Intervención Psicosocial Grupal (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 35,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Rescate no presencial (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 36,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Visita Integral de Salud Mental (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 37,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Actividad Comunitaria (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 38,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Actividades con organizaciones de usuarios y familiares (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 39,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Colaboración y formación con grupos de autoayuda (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 40,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Coordinación con Equipos de la red de salud (PCI/ SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 41,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Trabajo sectorial (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 42,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Trabajo intersectorial (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 43,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Actividades de cuidado del equipo (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 44,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Comité de ingreso a atención cerrada (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 45,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Consejo Técnico de Salud Mental en el Servicio de Salud (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 91,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Comité por Telemedicina', 'user_id'=>1]);
      Activity::Create(['id_activity' => 92,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Consulta Ingreso Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 93,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Consulta Control Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 94,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Intervención Familiar Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 95,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Intervención Psicosocial Grupal Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 96,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Visita Integral de Salud Mental Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 104,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Tele consultoría (Telemedicina)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 105,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Tele consulta abreviada (Telemedicina) ', 'user_id'=>1]);
      Activity::Create(['id_activity' => 106,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Atención remota: consulta nueva', 'user_id'=>1]);
      Activity::Create(['id_activity' => 107,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Atención remota: consulta control', 'user_id'=>1]);
      Activity::Create(['id_activity' => 108,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Atención remota: consulta abreviada', 'user_id'=>1]);
      Activity::Create(['id_activity' => 109,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Atención remota: consultoría', 'user_id'=>1]);
      Activity::Create(['id_activity' => 110,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Teletrabajo no programado', 'user_id'=>1]);
      Activity::Create(['id_activity' => 111,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Evaluación Intermedia remota', 'user_id'=>1]);
      Activity::Create(['id_activity' => 112,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Sesión de rehabilitación vía remota (Telerehabilitación)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 113,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Educación remota a usuario y/o cuidador', 'user_id'=>1]);
      Activity::Create(['id_activity' => 114,'mother_activity_id' => 2,'activity_type_id'=>1,'activity_name'=>'Rehabilitación domiciliaria', 'user_id'=>1]);



      //actividades NO médicas
      // Activity::Create(['id_activity' => 47,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Consultas totales (SM)', 'user_id'=>1]);
      // Activity::Create(['id_activity' => 3,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Atención de Servicio de Urgencia (Desde Atención Ambulatoria).', 'user_id'=>1]);
      // Activity::Create(['id_activity' => 48,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Procedimientos (apoyo en procedimientos médicos y propios)', 'user_id'=>1]);
      Activity::Create(['id_activity' => 47,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Consultas totales (SM)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 3,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Atención de Servicio de Urgencia (Desde Atención Ambulatoria).', 'user_id'=>1]);
        Activity::Create(['id_activity' => 48,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Procedimientos (apoyo en procedimientos médicos y propios)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 5,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Turno (Todas las unidades hospitalarias)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 49,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Pabellon', 'user_id'=>1]);
        Activity::Create(['id_activity' => 11,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Consultoría en salud', 'user_id'=>1]);
        Activity::Create(['id_activity' => 12,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Ronda otro establecimiento', 'user_id'=>1]);
        Activity::Create(['id_activity' => 16,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Visita Domiciliaria', 'user_id'=>1]);
        Activity::Create(['id_activity' => 17,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Gestión de Casos', 'user_id'=>1]);
        Activity::Create(['id_activity' => 50,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Consulta Abreviada no Médica', 'user_id'=>1]);
        Activity::Create(['id_activity' => 51,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Contrareferencia', 'user_id'=>1]);
        Activity::Create(['id_activity' => 52,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Taller Grupal', 'user_id'=>1]);
        Activity::Create(['id_activity' => 53,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Atención de Enlace o Interconsulta a sala', 'user_id'=>1]);
        Activity::Create(['id_activity' => 110,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Teleconsulta nueva (Telemedicina)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 111,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Teleconsulta control (Telemedicina)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 54,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Educación Individual', 'user_id'=>1]);
        Activity::Create(['id_activity' => 21,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Comité clínico', 'user_id'=>1]);
        Activity::Create(['id_activity' => 22,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Comité Oncológico', 'user_id'=>1]);
        Activity::Create(['id_activity' => 23,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Reunión Clínica', 'user_id'=>1]);
        Activity::Create(['id_activity' => 24,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Reunión Técnica Administrativa', 'user_id'=>1]);
        Activity::Create(['id_activity' => 25,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Otros Actividades Clínicas', 'user_id'=>1]);
        Activity::Create(['id_activity' => 26,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Gestión Organizacional (Administrativo/ Jefatura)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 27,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Investigación', 'user_id'=>1]);
        Activity::Create(['id_activity' => 28,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Docencia', 'user_id'=>1]);
        Activity::Create(['id_activity' => 29,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Otras Actividades No Clínicas', 'user_id'=>1]);
        Activity::Create(['id_activity' => 30,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Hospitalización Domiciliaria', 'user_id'=>1]);
        Activity::Create(['id_activity' => 55,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Conserjeria en salud MATRONA', 'user_id'=>1]);
        Activity::Create(['id_activity' => 56,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Atención Nutricional Intensiva (ANI)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 57,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Atención Nutricional en Sala', 'user_id'=>1]);
        Activity::Create(['id_activity' => 58,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Educación nutricional establecimiento o/y espacios públicos.', 'user_id'=>1]);
        Activity::Create(['id_activity' => 59,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Evaluación inicial', 'user_id'=>1]);
        Activity::Create(['id_activity' => 60,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Evaluación intermedia', 'user_id'=>1]);
        Activity::Create(['id_activity' => 61,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Sesiones de Rehabilitación', 'user_id'=>1]);
        Activity::Create(['id_activity' => 62,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Psicodiagnostico', 'user_id'=>1]);
        Activity::Create(['id_activity' => 63,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Psicoterapia Individual', 'user_id'=>1]);
        Activity::Create(['id_activity' => 64,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Psicoterapia Familiar', 'user_id'=>1]);
        Activity::Create(['id_activity' => 65,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Atención Medicina Transfusional por TM', 'user_id'=>1]);
        Activity::Create(['id_activity' => 66,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Examen Imagenologico por TM', 'user_id'=>1]);
        Activity::Create(['id_activity' => 67,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Examen Laboratorio por TM', 'user_id'=>1]);
        Activity::Create(['id_activity' => 68,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Examen APA por TM', 'user_id'=>1]);
        Activity::Create(['id_activity' => 69,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Otros Procedimientos realizados por TM', 'user_id'=>1]);
        Activity::Create(['id_activity' => 70,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Disp. y validación de prescripción en AA', 'user_id'=>1]);
        Activity::Create(['id_activity' => 71,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Disp. y validación de prescripción en AC', 'user_id'=>1]);
        Activity::Create(['id_activity' => 72,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Disp. y validación de prescripción en URG', 'user_id'=>1]);
        Activity::Create(['id_activity' => 73,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Disp. directa especificos', 'user_id'=>1]);
        Activity::Create(['id_activity' => 74,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Registro de recetas', 'user_id'=>1]);
        Activity::Create(['id_activity' => 75,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Preparados magistrales y/o oficinales No esteril', 'user_id'=>1]);
        Activity::Create(['id_activity' => 76,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Preparados magistrales y/o oficinales Esteril', 'user_id'=>1]);
        Activity::Create(['id_activity' => 77,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Fraccionamiento de envases', 'user_id'=>1]);
        Activity::Create(['id_activity' => 78,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Reenvasado de unidosis', 'user_id'=>1]);
        Activity::Create(['id_activity' => 79,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Conciliación farmacoterapeutica', 'user_id'=>1]);
        Activity::Create(['id_activity' => 80,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Revisión de la medicación', 'user_id'=>1]);
        Activity::Create(['id_activity' => 81,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Seguimiento farmacoterapéutico', 'user_id'=>1]);
        Activity::Create(['id_activity' => 82,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Educación farmacoterapeutica', 'user_id'=>1]);
        Activity::Create(['id_activity' => 83,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Monitorización terapeutica de farmacos', 'user_id'=>1]);
        Activity::Create(['id_activity' => 84,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Notificación de reacciones adversas de medicamentos', 'user_id'=>1]);
        Activity::Create(['id_activity' => 85,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Notificación de eventos adversos asociados de medicación', 'user_id'=>1]);
        Activity::Create(['id_activity' => 86,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Notificación de denuncias de calidad', 'user_id'=>1]);
        Activity::Create(['id_activity' => 87,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Educaciones grupales (usuarios y equipo de salud )', 'user_id'=>1]);
        Activity::Create(['id_activity' => 88,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Inventario', 'user_id'=>1]);
        Activity::Create(['id_activity' => 89,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Programacion, gestion de adquisición y registro.', 'user_id'=>1]);
        Activity::Create(['id_activity' => 90,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Secretario de comité de farmacia y técnico', 'user_id'=>1]);
        Activity::Create(['id_activity' => 91,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Comité por Telemedicina', 'user_id'=>1]);
        Activity::Create(['id_activity' => 97,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Consulta de Ingreso por Equipo Salud Mental', 'user_id'=>1]);
        Activity::Create(['id_activity' => 98,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Comité Articulador de Continuidad de Cuidados', 'user_id'=>1]);
        Activity::Create(['id_activity' => 99,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Comité de ingreso a atención cerrada (incluye Hospital de Día y UHCIP)(SM)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 92,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Consulta Ingreso Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 93,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Consulta Control Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 94,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Intervención Familiar Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 95,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Intervención Psicosocial Grupal Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 96,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Visita Integral de Salud Mental Hospital de Día y UHCIP (SM)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 100,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Consultas CONTROL POR PROFESIONAL  (SM)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 101,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Consultas NUEVAS (ESPECIALIDAD)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 102,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Consultas CONTROL (ESPECIALIDAD)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 103,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Contra referencia asistida', 'user_id'=>1]);
        Activity::Create(['id_activity' => 104,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Tele consultoría (Telemedicina)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 105,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Tele consulta abreviada (Telemedicina)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 106,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Atención remota: consulta nueva', 'user_id'=>1]);
        Activity::Create(['id_activity' => 107,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Atención remota: consulta control', 'user_id'=>1]);
        Activity::Create(['id_activity' => 108,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Atención remota: consulta abreviada', 'user_id'=>1]);
        Activity::Create(['id_activity' => 109,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Atención remota: consultoría', 'user_id'=>1]);
        Activity::Create(['id_activity' => 110,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Teletrabajo no programado', 'user_id'=>1]);
        Activity::Create(['id_activity' => 111,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Evaluación Intermedia remota', 'user_id'=>1]);
        Activity::Create(['id_activity' => 112,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Sesión de rehabilitación vía remota (Tele rehabilitación)', 'user_id'=>1]);
        Activity::Create(['id_activity' => 113,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Educación remota a usuario y/o cuidador', 'user_id'=>1]);
        Activity::Create(['id_activity' => 114,'mother_activity_id' => 2,'activity_type_id'=>2,'activity_name'=>'Rehabilitación domiciliaria', 'user_id'=>1]);

    }
}
