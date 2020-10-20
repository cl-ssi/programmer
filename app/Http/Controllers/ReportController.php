<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EHR\HETG\Rrhh;
use App\Exports\ReportExport;
use App\Exports\ReportExportCut;
use Maatwebsite\Excel\Facades\Excel;
use App\EHR\HETG\CutOffDate;
use Carbon\Carbon;
use App\EHR\HETG\UnscheduledProgramming;
use App\EHR\HETG\TheoreticalProgramming;

class ReportController extends Controller
{
    //


    public function exportcsv()
    {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=Reporte.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        //$filas = Rrhh::All();
        $filas = Rrhh::All();

        //$filas = Patient::all();

        $columnas = array(
            'RUN',
            'DV',
            'Nombres',
            'Apellido Paterno',
            'Apellido Materno',
            'Títuo Profesional'
        );

        $callback = function () use ($filas, $columnas) {
            $file = fopen('php://output', 'w');
            fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
            fputcsv($file, $columnas, ';');

            foreach ($filas as $fila) {
                fputcsv($file, array(
                    $fila->rut,
                    $fila->dv,
                    $fila->name,
                    $fila->fathers_family,
                    $fila->mothers_family,
                    $fila->job_title
                ), ';');
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }


    public function export()
    {
        return Excel::download(new ReportExport, 'Planilla Programación Médica y no Médica.xlsx');
    }

    public function exportcut(CutOffDate $cutoffdate)

    {
        //obtiene comienzo y termino del periodo
        $monday = Carbon::parse($cutoffdate->date)->startOfWeek();
        $sunday = Carbon::parse($cutoffdate->date)->endOfWeek();
        //obtiene datos programables del período
        $theoreticalProgrammings = TheoreticalProgramming::whereBetween('start_date', [$monday, $sunday])
            ->whereNull('contract_day_type')
            ->get();

        $date = new Carbon($cutoffdate->date);
        //obtiene datos NO programables del año
        $unscheduledProgrammings = UnscheduledProgramming::where('year', $date->get('year'))->get();

        //se obtiene fechas de inicio y termino de cada isEventOverDiv
        foreach ($theoreticalProgrammings as $key => $theoricalProgramming) {
            $start  = new Carbon($theoricalProgramming->start_date);
            $end    = new Carbon($theoricalProgramming->end_date);
            $theoricalProgramming->duration_theorical_programming = $start->diffInMinutes($end) / 60;
        }



        //programables - PROGRAMACION MÉDICA
        $array_programacion_medica = array();
        foreach ($theoreticalProgrammings->whereNotNull('specialty_id') as $key => $theoricalProgramming) {
            $array_programacion_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id][$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name][$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['assigned_hour'] = 0;
            $array_programacion_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id][$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name][$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['rdto_hour'] = 0;
            $array_programacion_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id][$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name][$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['theoricalProgramming_id'] = 0;
        }
        foreach ($theoreticalProgrammings->whereNotNull('specialty_id') as $key => $theoricalProgramming) {
            $array_programacion_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id][$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name][$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['assigned_hour'] += $theoricalProgramming->duration_theorical_programming;
            $array_programacion_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id][$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name][$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['rdto_hour'] = $theoricalProgramming->performance; //$theoricalProgramming->specialty->activities->where('id',$theoricalProgramming->activity->id)->first()->pivot->performance;
            $array_programacion_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id][$theoricalProgramming->specialty->id_specialty . ' - ' . $theoricalProgramming->specialty->specialty_name][$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['theoricalProgramming_id'] = $theoricalProgramming->id;
        }
        //NO programables - PROGRAMACION MÉDICA
        foreach ($unscheduledProgrammings->whereNotNull('specialty_id') as $key => $unscheduledProgramming) {
            $array_programacion_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id][$unscheduledProgramming->specialty->id_specialty . ' - ' . $unscheduledProgramming->specialty->specialty_name][$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['assigned_hour'] = 0;
            $array_programacion_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id][$unscheduledProgramming->specialty->id_specialty . ' - ' . $unscheduledProgramming->specialty->specialty_name][$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['rdto_hour'] = 0;
            $array_programacion_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id][$unscheduledProgramming->specialty->id_specialty . ' - ' . $unscheduledProgramming->specialty->specialty_name][$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['unscheduledProgramming'] = 0;
        }
        foreach ($unscheduledProgrammings->whereNotNull('specialty_id') as $key => $unscheduledProgramming) {
            $array_programacion_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id][$unscheduledProgramming->specialty->id_specialty . ' - ' . $unscheduledProgramming->specialty->specialty_name][$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['assigned_hour'] += $unscheduledProgramming->assigned_hour;
            $array_programacion_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id][$unscheduledProgramming->specialty->id_specialty . ' - ' . $unscheduledProgramming->specialty->specialty_name][$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['rdto_hour'] = $unscheduledProgramming->hour_performance; //$unscheduledProgramming->specialty->activities->where('id',$unscheduledProgramming->activity->id)->first()->pivot->performance;
            $array_programacion_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id][$unscheduledProgramming->specialty->id_specialty . ' - ' . $unscheduledProgramming->specialty->specialty_name][$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['unscheduledProgramming'] = $unscheduledProgramming->id;
        }




        //programables - PROGRAMACION NO MÉDICA
        $array_programacion_no_medica = array();
        foreach ($theoreticalProgrammings->whereNotNull('profession_id') as $key => $theoricalProgramming) {
            $array_programacion_no_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->profession->id_profession . ' - ' . $theoricalProgramming->profession->profession_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['assigned_hour'] = 0;
            $array_programacion_no_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->profession->id_profession . ' - ' . $theoricalProgramming->profession->profession_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['rdto_hour'] = 0;
            $array_programacion_no_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->profession->id_profession . ' - ' . $theoricalProgramming->profession->profession_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['theoricalProgramming_id'] = 0;
        }
        foreach ($theoreticalProgrammings->whereNotNull('profession_id') as $key => $theoricalProgramming) {
            $array_programacion_no_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->profession->id_profession . ' - ' . $theoricalProgramming->profession->profession_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['assigned_hour'] += $theoricalProgramming->duration_theorical_programming;
            $array_programacion_no_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->profession->id_profession . ' - ' . $theoricalProgramming->profession->profession_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['rdto_hour'] = $theoricalProgramming->performance;//$theoricalProgramming->profession->activities->where('id',$theoricalProgramming->activity->id)->first()->pivot->performance;
            $array_programacion_no_medica[$theoricalProgramming->rut][$theoricalProgramming->contract->contract_id]
                                      [$theoricalProgramming->profession->id_profession . ' - ' . $theoricalProgramming->profession->profession_name]
                                      [$theoricalProgramming->activity->id_activity . ' - ' . $theoricalProgramming->activity->activity_name]['theoricalProgramming_id'] = $theoricalProgramming->id;
        }
        //NO programables - PROGRAMACION NO MÉDICA
        foreach ($unscheduledProgrammings->whereNotNull('profession_id') as $key => $unscheduledProgramming) {
            $array_programacion_no_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id]
                                      [$unscheduledProgramming->profession->id_profession . ' - ' . $unscheduledProgramming->profession->profession_name]
                                      [$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['assigned_hour'] = 0;
            $array_programacion_no_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id]
                                      [$unscheduledProgramming->profession->id_profession . ' - ' . $unscheduledProgramming->profession->profession_name]
                                      [$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['rdto_hour'] = 0;
            $array_programacion_no_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id]
                                      [$unscheduledProgramming->profession->id_profession . ' - ' . $unscheduledProgramming->profession->profession_name]
                                      [$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['unscheduledProgramming'] = 0;
        }
        foreach ($unscheduledProgrammings->whereNotNull('profession_id') as $key => $unscheduledProgramming) {
            $array_programacion_no_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id]
                                      [$unscheduledProgramming->profession->id_profession . ' - ' . $unscheduledProgramming->profession->profession_name]
                                      [$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['assigned_hour'] += $unscheduledProgramming->assigned_hour;
            $array_programacion_no_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id]
                                      [$unscheduledProgramming->profession->id_profession . ' - ' . $unscheduledProgramming->profession->profession_name]
                                      [$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['rdto_hour'] = $unscheduledProgramming->hour_performance;//$unscheduledProgramming->profession->activities->where('id',$unscheduledProgramming->activity->id)->first()->pivot->performance;
            $array_programacion_no_medica[$unscheduledProgramming->rut][$unscheduledProgramming->contract->contract_id]
                                      [$unscheduledProgramming->profession->id_profession . ' - ' . $unscheduledProgramming->profession->profession_name]
                                      [$unscheduledProgramming->activity->id_activity . ' - ' . $unscheduledProgramming->activity->activity_name]['unscheduledProgramming'] = $unscheduledProgramming->id;
        }


        return Excel::download(new ReportExportCut($cutoffdate,$array_programacion_medica,$array_programacion_no_medica), 'Planilla Programación.xlsx');
    }
}
