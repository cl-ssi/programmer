<?php

namespace App\Http\Controllers\EHR\HETG;

use App\EHR\HETG\MotherActivity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\EHR\HETG\Rrhh;
use App\EHR\HETG\Contract;
use App\EHR\HETG\ExecutedActivity;
use App\EHR\HETG\OperatingRoom;
use App\EHR\HETG\MedicalProgramming;
// use App\EHR\HETG\TheoreticalProgramming;
use App\EHR\HETG\CalendarProgramming;
use App\EHR\HETG\Specialty;

class OperatingRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operatingRooms = OperatingRoom::All();
        return view('ehr.hetg.operating_rooms.index', compact('operatingRooms'));
    }

    public function programmer()
    {
        return view('ehr.hetg.operating_rooms.programmer');
    }

    public function reportSpecialty(Request $request)
    {
        /* Ids correspondiente a las especialidades */
        // $ids_especialidades = array(72002,72001,74009,77002,77001);
        // $ids_specialities = array('9','13','15','19','33'); //variable

        /* Los ids que representan las horas de pabellón */
        // $ids_actividades_pabellon = array(6,7,8);
        // $ids_actividades = array('6','7','8');
        $motherActivities = MotherActivity::where('id',1)->get();
        $ids_actividades = $motherActivities->first()->activities->pluck('id')->toArray(); //se obtienen actividades de pabellón

        if($request->has('year_week')) {
            $now = Carbon::now();
            list($year, $week) = explode('-W',$request->year_week);
            $now->setISODate($year,$week);
            $from = $now->startOfWeek()->format('Y-m-d 00:00:00');
            $to   = $now->endOfWeek()->format('Y-m-d 23:59:59');
        }
        else if($request->has('from') AND $request->has('to')){
            $from = $request->has('from'). ' 00:00:00';
            $to   = $request->has('to'). ' 23:59:59';
        }
        else {
            $now = Carbon::now();
            $from = $now->startOfWeek()->format('2020-02-24 00:00:00');
            $to   = $now->endOfWeek()->format('2020-03-01 23:59:59');
        }

        //programación pabellón
        $calendarProgrammings = CalendarProgramming::whereBetween('start_date',[$from,$to])->get();
        foreach ($calendarProgrammings as $key => $calendarProgramming) {
          $calendarProgramming->specialty_id = $calendarProgramming->specialty->id_n820;
        }

        //obtiene programación médica anual
        $programacion = MedicalProgramming::where('year', '2020')->whereIn('activity_id', $ids_actividades)
                // ->whereIn('specialty_id', $ids_specialities)
                ->get();

        //se agrega para dejar como id, al n820
        foreach ($programacion as $key => $progra) {
          $progra->specialty_id = $progra->specialty->id_n820;
        }
        $programacion_agrupada = $programacion->groupBy('specialty_id');


        $resumen = [];
        /* Calculo de horas contratadas e inicialización de variables */
        foreach($programacion_agrupada as $codigo_especialidad => $horas_programadas) {
            $resumen[$codigo_especialidad]['nombre_especialidad'] = $horas_programadas->first()->specialty;
            $resumen[$codigo_especialidad]['horas_contratadas'] = $horas_programadas->sum('assigned_hour');
            $resumen[$codigo_especialidad]['horas_programadas'] = 0;
            $resumen[$codigo_especialidad]['horas_ejecutadas'] = 0;
            $resumen[$codigo_especialidad]['horas_habiles'] = 0;
            $resumen[$codigo_especialidad]['horas_inhabiles'] = 0;
        }

        foreach ($calendarProgrammings as $key => $calendarProgramming) {
          $start  = new Carbon($calendarProgramming->start_date);
          $end    = new Carbon($calendarProgramming->end_date);
          $resumen[$calendarProgramming->specialty_id]['horas_programadas'] += $start->diffInMinutes($end)/60;
        }
        // dd($resumen);

        //se obtienen id asociados idn820 para obtener de tabla de ejecutados
        $specialties = Specialty::all();//whereIn('id',$ids_specialities)->get();
        $ids_specialties_n820 = $specialties->pluck('id_n820')->toArray();
        $actividades_ejecutadas = ExecutedActivity::whereBetween('fecha_inicio_intervencion',[$from,$to])
                                    ->whereIn('medico_especialidad',$ids_specialties_n820)
                                    ->get();
        // dd($actividades_ejecutadas);
        $actividades_ejecutadas_agrupadas = $actividades_ejecutadas->groupBy(['medico_especialidad','correlativo','medico_rut']);
        // dd($actividades_ejecutadas_agrupadas);

        $horas_ejecutadas = [];
        if($actividades_ejecutadas_agrupadas->count() >= 1) {
            /* Inicializar colección */
            $horas_ejecutadas_especialidad = collect();

            foreach($actividades_ejecutadas_agrupadas as $codigo_especialidad => $especialidad) {
                $horas_ejecutadas[$codigo_especialidad] = collect();
                foreach($especialidad as $numero_correlativo => $correlativo) {
                    foreach($correlativo as $rut_medico => $medico) {
                        /* Crear nueva colección solo con los primeros elementos (agrupar)*/
                        if($medico->first()->fecha_inicio_intervencion->format('H') >= 8
                            AND $medico->first()->fecha_inicio_intervencion->format('H') <= 16){
                            $medico->first()->habil = true;
                        }
                        else {
                            $medico->first()->habil = false;
                        }
                        $horas_ejecutadas[$codigo_especialidad]->push($medico->first());
                    }
                }
            }

            // dd(array_keys($resumen));
            // dd($horas_ejecutadas);
            // foreach ($resumen as $key => $value) {
            //   dd($key);
            // }

            /* Calculo de horas ejecutadas */
            foreach($horas_ejecutadas as $codigo_especialidad => $medicos) {
              // dd($codigo_especialidad);
              if (in_array($codigo_especialidad,array_keys($resumen))) {
                $resumen[$codigo_especialidad]['horas_ejecutadas'] = number_format($medicos->sum('activityDuration')/60/60,1);
                $resumen[$codigo_especialidad]['horas_habiles'] = number_format($medicos->where('habil', true)->sum('activityDuration')/60/60,1);
                $resumen[$codigo_especialidad]['horas_inhabiles'] = number_format($medicos->where('habil', false)->sum('activityDuration')/60/60,1);
              }
            }
        }

        // //obtener programación
        // $theoreticalProgrammings = TheoreticalProgramming::all();
        // //se obtiene programación médica para comparar specialidades con actvidades del teórico
        // $programacion = MedicalProgramming::where('year', '2020')->whereIn('activity_id', $ids_actividades)->get();
        // $programacion_agrupada = $programacion->groupBy('specialty_id');
        // foreach ($programacion_agrupada as $key => $grupo) {
        //   foreach ($grupo as $key => $programacion) {
        //
        //     //se recorren horarios teóricos
        //     foreach ($theoreticalProgrammings as $key => $theoreticalProgramming) {
        //       // dd($theoreticalProgramming->activity_id);
        //       if ($programacion->activity_id == $theoreticalProgramming->activity_id) {
        //         //AVISO: en este if, se da una interrogante. Cuales actividades debo considerar para el teórico
        //         // dd($theoreticalProgramming);
        //       }
        //     }
        //   }
        // }


        // dd($resumen);
        // echo '<pre>';
        // print_r($horas_ejecutadas);
        // die();
        $request->flash();

        return view('ehr.hetg.management.reports.specialty',compact('now','resumen','horas_ejecutadas'));
    }

    public function reportByProfesional(Request $request)
    {
        /* Los ids que representan las horas de pabellón */
        // $ids_actividades_pabellon = array('6','7','8');
        $motherActivities = MotherActivity::where('id',1)->get();
        $ids_actividades = $motherActivities->first()->activities->pluck('id')->toArray(); //se obtienen actividades de pabellón

        $now = Carbon::now();
        $profesional = new Rrhh();

        if($request->has('rut') AND $request->has('year_week')) {
            list($year, $week) = explode('-W',$request->year_week);
            $now->setISODate($year,$week);
            $profesional = Rrhh::where('rut',$request->rut)->first();
        }

        /* Listado de médicos que sean cirujanos */
        // $rrhh = Rrhh::where('job_title','like','%CIRUJAN%')
        //         ->orderBy('name')
        //         ->orderBy('fathers_family')
        //         ->get
        $rrhh = Rrhh::all();

        /* Listado de contratos del año selecionado */
        $contracts = $profesional->contracts->where('year',$now->startOfWeek()->format('Y'));

        /* Programación del profesional del año seleccionado */
        $programming = $profesional->medical_programmings->where('year',$now->startOfWeek()->format('Y'));

        /* Programación de pabellon */
        $programacion_pabellon = $programming->whereIn('activity_id',$ids_actividades);

        /* Programación de otras actividades */
        $programacion_otras_actividades = $programming->whereNotIn('activity_id',$ids_actividades);

        /* Inicializar colección */
        $current_activities = collect();


        /* Listado de actividades ejecutadas agrupadas por correlativo */
        $current_activities_grouped = $profesional->executedActivities
            ->whereBetween('fecha_inicio_intervencion',
                [$now->startOfWeek()->format('Y-m-d H:i:s'),
                 $now->endOfWeek()->format('Y-m-d H:i:s')])
                 ->groupBy('correlativo');

        /* Loop para determinar horario habil o inhabil y agrupar los procedimienots */
        foreach($current_activities_grouped as $correlativo) {
            /* Loop para obtener todos los procedimientos */
            foreach($correlativo as $procedimiento) {
                $procedimientos[] = $procedimiento->procedimiento_intervencion;
            }
            /* Crear nueva variable procedimientos y agregarla al primer elemento */
            $correlativo[0]->procedimientos = implode("<br> ", $procedimientos);

            /* Determinar si es horario habil o inabil */
            if($correlativo[0]->fecha_inicio_intervencion->format('H') >= 8
                AND $correlativo[0]->fecha_inicio_intervencion->format('H') <= 16 ) {
                $correlativo[0]->habil = true;
            }
            else {
                $correlativo[0]->habil = false;
            }

            /* Crear nueva colección solo con los primeros elementos (agrupar)*/
            $current_activities->push($correlativo[0]);
        }

        //programación pabellón);
        $calendarProgrammings = CalendarProgramming::where('rut',$profesional->rut)->whereBetween('start_date',[$now->startOfWeek()->format('Y-m-d H:i:s'),$now->endOfWeek()->format('Y-m-d H:i:s')])->get();
        foreach ($calendarProgrammings as $key => $calendarProgramming) {
          $start  = new Carbon($calendarProgramming->start_date);
          $end    = new Carbon($calendarProgramming->end_date);
          $calendarProgramming->duration =  $start->diffInMinutes($end)/60;
        }

        /* Calculo de total de horas contratadas */
        $total_contratadas = $total_ejecutadas = $total_habil = $total_inhabil = 0;

        $total_contratadas = $programacion_pabellon->sum('assigned_hour')*60*60;
        $total_programadas = $calendarProgrammings->sum('duration');
        $total_ejecutadas = $current_activities->sum('activityDuration');
        $total_habil = $current_activities->where('habil',true)->sum('activityDuration');
        $total_inhabil = $current_activities->where('habil',false)->sum('activityDuration');

        $total_contratadas = gmdate("H:i:s", $total_contratadas);
        $total_ejecutadas = gmdate("H:i:s", $total_ejecutadas);
        $total_habil = gmdate("H:i:s", $total_habil);
        $total_inhabil = gmdate("H:i:s", $total_inhabil);

        return view('ehr.hetg.management.reports.by_profesional',
            compact('rrhh','now','profesional','current_activities','contracts',
            'programacion_pabellon','programacion_otras_actividades',
            'total_contratadas', 'total_ejecutadas','total_habil','total_inhabil','total_programadas'));
    }

    public function reportWeekly(Request $request)
    {
      $now = Carbon::now();
      if($request->has('year_week')) {
          list($year, $week) = explode('-W',$request->year_week);
          $now->setISODate($year,$week);
      }
      $operatingRoom_name = $request->operatingRoom;

      $colors = ['EBDEF0','FDEBD0','F6DDCC','F2D7D5','D6EAF8','EAEDED','D4E6F1','FDEBD0','FADBD8','D5F5E3'];
      $operatingRooms = OperatingRoom::orderBy('id','ASC')->get();
      $current_activities = ExecutedActivity::select('correlativo','medico_especialidad_desc','fecha_inicio_intervencion','fecha_termino_intervencion')
                                             ->whereBetween('fecha_inicio_intervencion',[$now->startOfWeek()->format('Y-m-d H:i:s'),$now->endOfWeek()->format('Y-m-d H:i:s')])
                                             ->where('pabellon',$operatingRoom_name)
                                             ->groupBy('correlativo','medico_especialidad_desc','fecha_inicio_intervencion','fecha_termino_intervencion')
                                             ->get();

      $specialties = ExecutedActivity::select('medico_especialidad_desc',
                                                DB::raw('count(*) as totalProcedimientos'),
                                                DB::raw('ROUND((SUM(TIMESTAMPDIFF(MINUTE, fecha_inicio_intervencion, fecha_termino_intervencion))/60),2) AS total_horas'),
                                                DB::raw('ROUND(AVG((TIMESTAMPDIFF(MINUTE, fecha_inicio_intervencion, fecha_termino_intervencion)/60)),2) AS promedio_duracion_intervencion'))
                                             ->whereBetween('fecha_inicio_intervencion',[$now->startOfWeek()->format('Y-m-d H:i:s'),$now->endOfWeek()->format('Y-m-d H:i:s')])
                                             ->where('pabellon',$operatingRoom_name)
                                             ->groupBy('medico_especialidad_desc')
                                             ->orderBy('totalProcedimientos','DESC')
                                             ->get();

      $tooltip_info = ExecutedActivity::select('correlativo','medico_nombre','profesion','procedimiento_intervencion_desc','fecha_inicio_intervencion','fecha_termino_intervencion')
                                    ->whereBetween('fecha_inicio_intervencion',[$now->startOfWeek()->format('Y-m-d H:i:s'),$now->endOfWeek()->format('Y-m-d H:i:s')])
                                    ->where('pabellon','LIKE',$operatingRoom_name)
                                    ->orderBy('correlativo', 'ASC')->orderBy('medico_nombre', 'ASC')
                                    ->get();

      //dd($tooltip_info);
      foreach ($current_activities as $key => $activity) {
        //$valor = '<table>';
        $valor = '';
        foreach ($tooltip_info as $key => $info) {
          if($activity->correlativo == $info->correlativo){
            //$valor = $valor . '<tr><td>' . $info->medico_nombre . '</td><td>' . $info->profesion . '</td></tr>';
            $valor = $valor . $info->medico_nombre . ' - ' . $info->profesion . ' - ' . $info->procedimiento_intervencion_desc . '<br>';
          }
        }
        //$valor = $valor . '</table>';
        $activity->tooltip = $valor;
      }

      //dd($current_activities);

      foreach ($specialties as $key => $specialty) {
        $specialty->color = $colors[$key];
        $specialty->prom = round(($specialty->total_horas * 100 / $specialties->sum('total_horas')),2);
      }
      $specialties = $specialties->sortByDesc('prom');

      return view('ehr.hetg.management.reports.weekly',compact('now','current_activities','operatingRooms','specialties','operatingRoom_name'));
    }

    public function reportDiary(Request $request)
    {
      //$now = Carbon::now();
      $now = $request->get('day');
      //$now = Carbon::createFromFormat('Y-m-d\TH:i',$request->get('day'))->format('Y-m-d 08:00:00');
      //dd($now);

      $colors = ['EBDEF0','FDEBD0','F6DDCC','F2D7D5','D6EAF8','EAEDED','D4E6F1','FDEBD0','FADBD8','D5F5E3'];
      $operatingRooms = OperatingRoom::orderBy('id','ASC')->get();
      $current_activities = ExecutedActivity::select('correlativo','pabellon','medico_especialidad_desc','fecha_inicio_intervencion','fecha_termino_intervencion')
                                            ->whereBetween('fecha_inicio_intervencion', [$now . " 00:00:00", $now . " 23:59:59"])
                                            ->groupBy('correlativo','pabellon','medico_especialidad_desc','fecha_inicio_intervencion','fecha_termino_intervencion')
                                            ->get();
      $specialties = ExecutedActivity::select('medico_especialidad_desc',
                                               DB::raw('count(*) as totalProcedimientos'),
                                               DB::raw('ROUND((SUM(TIMESTAMPDIFF(MINUTE, fecha_inicio_intervencion, fecha_termino_intervencion))/60),2) AS total_horas'),
                                               DB::raw('ROUND(AVG((TIMESTAMPDIFF(MINUTE, fecha_inicio_intervencion, fecha_termino_intervencion)/60)),2) AS promedio_duracion_intervencion'))
                                            ->whereBetween('fecha_inicio_intervencion', [$now . " 00:00:00", $now . " 23:59:59"])
                                            ->groupBy('medico_especialidad_desc')
                                            // ->orderBy('totalProcedimientos','DESC')
                                            ->get();

      $tooltip_info = ExecutedActivity::select('correlativo','medico_nombre','profesion','procedimiento_intervencion_desc','fecha_inicio_intervencion','fecha_termino_intervencion')
                                    ->whereBetween('fecha_inicio_intervencion', [$now . " 00:00:00", $now . " 23:59:59"])
                                    ->orderBy('correlativo', 'ASC')->orderBy('medico_nombre', 'ASC')
                                    ->get();

      //se agregan tooltip a actividades del calendario
      foreach ($current_activities as $key => $activity) {
        $valor = '';
        foreach ($tooltip_info as $key => $info) {
          if($activity->correlativo == $info->correlativo){
            $valor = $valor . $info->medico_nombre . ' - ' . $info->profesion . ' - ' . $info->procedimiento_intervencion_desc . '<br>';
          }
        }
        $activity->tooltip = $valor;
      }

      //se agrega promedio a especialidades agrupadas
      // $specialties = Specialty::all();

      foreach ($specialties as $key => $specialty) {
        $specialty->color = $colors[$key];
        $specialty->prom = round(($specialty->total_horas * 100 / $specialties->sum('total_horas')),2);
      }
      $specialties = $specialties->sortByDesc('prom');
      // dd($specialties);

      return view('ehr.hetg.management.reports.diary',compact('now','current_activities','operatingRooms','specialties','colors'));
    }

    public function report1(Request $request)
    {
      $from = $request->get('from');
      $to = $request->get('to');
      //$operatingRoom = $request->operatingRoom;

      //$operatingRooms = OperatingRoom::orderBy('id','ASC')->get();

      $colors = ['EBDEF0','FDEBD0','F6DDCC','F2D7D5','D6EAF8','EAEDED','D4E6F1','FDEBD0','FADBD8','D5F5E3'];
      //total de horas uso por medico
      // $executedActivity = ExecutedActivity::select('medico_especialidad_desc','medico_nombre',
      //                                           DB::raw('count(*) as totalProcedimientos'),
      //                                           DB::raw('ROUND((SUM(TIMESTAMPDIFF(MINUTE, fecha_inicio_intervencion, fecha_termino_intervencion))/60),2) AS total_horas'))
      //                                        ->whereBetween('fecha_inicio_intervencion',[$from . " 00:00:00", $to . " 23:59:59"])
      //                                        ->where('pabellon','PC4')
      //                                        ->groupBy('medico_especialidad_desc','medico_nombre')
      //                                        ->orderBy('totalProcedimientos','DESC')
      //                                        ->get();

      $sql_query = "SELECT T2.law,T2.weekly_hours, IFNULL(T2.YEAR, anho) AS anho, IFNULL(T2.rut,medico_rut) AS rut, IFNULL(NAME, medico_nombre) AS nombre, T.mes, T.Semana, T.medico_especialidad_desc, T.total_horas
                    FROM (SELECT Anho,
                    		       Mes,
                    				 Semana,
                    				 medico_especialidad_desc,
                    				 medico_rut,
                    				 medico_nombre,
                    				 ROUND((SUM(TIMESTAMPDIFF(MINUTE, T.fecha_inicio_intervencion, T.fecha_termino_intervencion))/60),2) AS total_horas
                    		FROM (
                    		SELECT YEAR(fecha_inicio_intervencion) AS Anho,
                    				 MONTHNAME(fecha_inicio_intervencion) AS Mes,
                    				 FLOOR((DayOfMonth(fecha_inicio_intervencion)-1)/7)+1 AS Semana,
                    				 medico_especialidad_desc, medico_rut, medico_nombre,
                    				 fecha_inicio_intervencion, fecha_termino_intervencion,profesion
                    		FROM hm_executed_activities
                    		where fecha_inicio_intervencion BETWEEN '$from 00:00:00' AND '$to 23:59:59'
                    		AND pabellon = 'PC4'
                    		GROUP BY YEAR(fecha_inicio_intervencion),
                    		         MONTHNAME(fecha_inicio_intervencion),
                    				   FLOOR((DayOfMonth(fecha_inicio_intervencion)-1)/7)+1,
                    				   medico_rut, medico_nombre, medico_especialidad_desc, fecha_inicio_intervencion, fecha_termino_intervencion,profesion) AS T
                    		GROUP BY Anho,
                    		         Mes,
                    					Semana,
                    					medico_especialidad_desc,
                    					medico_rut,
                    					medico_nombre
                    		ORDER BY ROUND((SUM(TIMESTAMPDIFF(MINUTE, T.fecha_inicio_intervencion, T.fecha_termino_intervencion))/60),2) DESC) AS T RIGHT JOIN
                    (SELECT rrhh.rut, (concat(rrhh.NAME,' ',fathers_family,' ',mothers_family)) AS name, cont.YEAR, cont.law, cont.weekly_hours
                    FROM hm_rrhh AS rrhh INNER JOIN
                         hm_contracts AS cont ON rrhh.rut = cont.rut
                    WHERE cont.law = 'LEY 15.076') AS T2 ON T.Anho = T2.YEAR AND T.medico_rut = T2.rut

                    UNION

                    SELECT T2.law,T2.weekly_hours, IFNULL(T2.YEAR, anho) AS anho, IFNULL(T2.rut,medico_rut) AS rut, IFNULL(NAME, medico_nombre) AS nombre, T.mes, T.Semana, T.medico_especialidad_desc, T.total_horas
                    FROM (SELECT Anho,
                    		       Mes,
                    				 Semana,
                    				 medico_especialidad_desc,
                    				 medico_rut,
                    				 medico_nombre,
                    				 ROUND((SUM(TIMESTAMPDIFF(MINUTE, T.fecha_inicio_intervencion, T.fecha_termino_intervencion))/60),2) AS total_horas
                    		FROM (
                    		SELECT YEAR(fecha_inicio_intervencion) AS Anho,
                    				 MONTHNAME(fecha_inicio_intervencion) AS Mes,
                    				 FLOOR((DayOfMonth(fecha_inicio_intervencion)-1)/7)+1 AS Semana,
                    				 medico_especialidad_desc, medico_rut, medico_nombre,
                    				 fecha_inicio_intervencion, fecha_termino_intervencion,profesion
                    		FROM hm_executed_activities
                    		where fecha_inicio_intervencion BETWEEN '$from 00:00:00' AND '$to 23:59:59'
                    		AND pabellon = 'PC4'
                    		GROUP BY YEAR(fecha_inicio_intervencion),
                    		         MONTHNAME(fecha_inicio_intervencion),
                    				   FLOOR((DayOfMonth(fecha_inicio_intervencion)-1)/7)+1,
                    				   medico_rut, medico_nombre, medico_especialidad_desc, fecha_inicio_intervencion, fecha_termino_intervencion,profesion) AS T
                    		GROUP BY Anho,
                    		         Mes,
                    					Semana,
                    					medico_especialidad_desc,
                    					medico_rut,
                    					medico_nombre
                    		ORDER BY ROUND((SUM(TIMESTAMPDIFF(MINUTE, T.fecha_inicio_intervencion, T.fecha_termino_intervencion))/60),2) DESC) AS T LEFT JOIN
                    (SELECT rrhh.rut, (concat(rrhh.NAME,' ',fathers_family,' ',mothers_family)) AS name, cont.YEAR, cont.law, cont.weekly_hours
                    FROM hm_rrhh AS rrhh INNER JOIN
                         hm_contracts AS cont ON rrhh.rut = cont.rut
                    WHERE cont.law = 'LEY 15.076') AS T2 ON T.Anho = T2.YEAR AND T.medico_rut = T2.rut

                    ORDER BY total_horas DESC";
      $executed_activities = DB::connection('mysql')->select($sql_query);

      // dd($executed_activities);

      //promedio de uso pabellon por especialidad
      // $average_total = ExecutedActivity::select('medico_especialidad_desc',
      //                                           DB::raw('ROUND((SUM(TIMESTAMPDIFF(MINUTE, fecha_inicio_intervencion, fecha_termino_intervencion))/60),2) AS total_horas'),
      //                                           DB::raw('ROUND(AVG((TIMESTAMPDIFF(MINUTE, fecha_inicio_intervencion, fecha_termino_intervencion)/60)),2) AS promedio_duracion_intervencion'))
      //                                        ->whereBetween('fecha_inicio_intervencion',[$from . " 00:00:00", $to . " 23:59:59"])
      //                                        ->where('pabellon','PC4')
      //                                        ->groupBy('medico_especialidad_desc')
      //                                        ->get();

      $sql_query = "SELECT medico_especialidad_desc,
                				 ROUND((SUM(TIMESTAMPDIFF(MINUTE, T.fecha_inicio_intervencion, T.fecha_termino_intervencion))/60),2) AS total_horas,
                         ROUND(AVG((TIMESTAMPDIFF(MINUTE, T.fecha_inicio_intervencion, T.fecha_termino_intervencion)/60)),2) AS promedio_duracion_intervencion
                		FROM (
                		SELECT YEAR(fecha_inicio_intervencion) AS Anho,
                				 MONTHNAME(fecha_inicio_intervencion) AS Mes,
                				 FLOOR((DayOfMonth(fecha_inicio_intervencion)-1)/7)+1 AS Semana,
                				 medico_especialidad_desc, medico_rut, medico_nombre,
                				 fecha_inicio_intervencion, fecha_termino_intervencion,profesion
                		FROM hm_executed_activities
                		where fecha_inicio_intervencion BETWEEN '$from 00:00:00' AND '$to 23:59:59'
                		AND pabellon = 'PC4'
                		GROUP BY YEAR(fecha_inicio_intervencion),
                		         MONTHNAME(fecha_inicio_intervencion),
                				   FLOOR((DayOfMonth(fecha_inicio_intervencion)-1)/7)+1,
                				   medico_rut, medico_nombre, medico_especialidad_desc, fecha_inicio_intervencion, fecha_termino_intervencion,profesion) AS T
                		GROUP BY medico_especialidad_desc";

      $average_total = DB::connection('mysql')->select($sql_query);
      $average_total = collect($average_total);
      //dd($average_total);

      //se agrega promedio a especialidades agrupadas
      foreach ($average_total as $key => $specialty) {
        $specialty->color = $colors[$key];
        $specialty->prom = round(($specialty->total_horas * 100 / $average_total->sum('total_horas')),2);
      }
      $average_total = $average_total->sortByDesc('prom');

      foreach ($executed_activities as $key => $executed) {
        $executed->color = null;
        foreach ($average_total as $key => $average) {
          if($executed->medico_especialidad_desc == $average->medico_especialidad_desc){
            $executed->color = $average->color;
          }
        }
      }
      //dd($executed_activities);
      // foreach ($executed_activities as $key => $specialty) {
      //   foreach ($average_total as $key => $average) {
      //     $specialty->
      //   }
      //   $specialty->color = $colors[$key];
      // }

      return view('ehr.hetg.management.reports.report1',compact('from','to','average_total','executed_activities',));
    }

    public function reportUrgency(Request $request)
    {
        $from = '2020-02-01 00:00:00';
        $to = '2020-03-12 23:59:59';
        /* Los ids que representan las horas de pabellón */
        $ids_actividades_pabellon = array(6,7,8);

        //echo '<pre>';

        $rrhh = Rrhh::orderBy('name')
                ->where('job_title','like','%CIRUJAN%')
                ->whereHas('contracts', function ($q) {
                    $q->where('law', 'LEY 15.076');
                })->with('contracts')->get();

        foreach($rrhh as $usuario) {
            $resumen[$usuario->rut]['nombre'] = $usuario->fullName;
            $resumen[$usuario->rut]['cod_especialidad'] = '';
            $resumen[$usuario->rut]['nombre_especialidad'] = '';
            $resumen[$usuario->rut]['horas_programadas'] = $usuario->contracts->where('law', 'LEY 15.076')->sum('weekly_hours');
            $resumen[$usuario->rut]['horas_ejecutadas'] = 0;
            //$resumen[$usuario->rut]['titulo'] = $usuario->job_title;
        }

        $actividades = ExecutedActivity::where('pabellon','PC4')
            ->whereBetween('fecha_inicio_intervencion',[$from,$to])
            ->get();

        $actividades_agrupadas = $actividades->groupBy(['medico_especialidad','correlativo','medico_rut']);

        foreach($actividades_agrupadas as $cod_esp => $especialidades) {
            $horas_ejecutadas_especialidad[$cod_esp] = collect();
            foreach($especialidades as $correlativos) {
                foreach($correlativos as $medicos) {
                    $horas_ejecutadas_especialidad[$cod_esp]->push($medicos->first());
                }
            }
        }
        //print_r($horas_ejecutadas_especialidad[72002]->sum('activityDuration'));

        foreach($horas_ejecutadas_especialidad as $key => $horas) {
            $resumen_por_especialidad[$key]['nombre'] = $horas->first()->medico_especialidad_desc;
            $resumen_por_especialidad[$key]['horas'] = number_format($horas->sum('activityDuration')/60/60,2);
            foreach($horas->groupBy('medico_rut') as $arr_medico) {
                $resumen[$arr_medico->first()->medico_rut]['nombre'] = $arr_medico->first()->medico_nombre;
                $resumen[$arr_medico->first()->medico_rut]['cod_especialidad'] = $arr_medico->first()->medico_especialidad;
                $resumen[$arr_medico->first()->medico_rut]['nombre_especialidad'] = $arr_medico->first()->medico_especialidad_desc;
                $resumen[$arr_medico->first()->medico_rut]['horas_ejecutadas'] = number_format($arr_medico->sum('activityDuration')/60/60,1);
                if(!isset($resumen[$arr_medico->first()->medico_rut]['horas_programadas'])) $resumen[$arr_medico->first()->medico_rut]['horas_programadas'] = 0;
            }
        }


        return view('ehr.hetg.operating_rooms.reports.urgency', compact('resumen','resumen_por_especialidad'));
        //print_r($resumen_por_especialidad);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ehr.hetg.operating_rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $operatingRoom = new OperatingRoom($request->All());
        //$operatingRoom->establishment_id = 1;
        $operatingRoom->save();

        return redirect()->route('ehr.hetg.operating_rooms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SurgicalPavilion  $surgicalPavilion
     * @return \Illuminate\Http\Response
     */
    public function show(SurgicalPavilion $surgicalPavilion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pharmacies\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(OperatingRoom $operatingRoom)
    {
        return view('ehr.hetg.operating_rooms.edit', compact('operatingRoom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pharmacies\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OperatingRoom $operatingRoom)
    {
        $operatingRoom->fill($request->all());
        $operatingRoom->save();

        session()->flash('info', 'El pabellón ha sido editado.');
        return redirect()->route('ehr.hetg.operating_rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pharmacies\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(OperatingRoom $operatingRoom)
    {
      //se elimina la cabecera y detalles
      $operatingRoom->delete();
      session()->flash('success', 'El pabellón ha sido eliminado');
      return redirect()->route('ehr.hetg.operating_rooms.index');
    }
}
