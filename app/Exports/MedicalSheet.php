<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\EHR\HETG\UnscheduledProgramming;

class MedicalSheet implements FromCollection, WithTitle, WithHeadings, WithMapping, ShouldAutoSize
{


    /**
     * @return Builder
     */

    public function headings(): array
    {
        return [
          'Rut',
          //'ID_Especialidad',
          'Especialidad',
          'ID_Actividad',
          'Actividades',
          'Horas Asignadas',
          'Rendimiento por Hora',
          'Total Horas semanales del Contrato',
          '% asignado del contrato',
        ];
    }




    public function collection()
    {
        return UnscheduledProgramming::all();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Programación Médica';
    }


    public function map($unscheduledProgramming): array
    {
        if($unscheduledProgramming->hour_performance)
            {
               $porcentaje=round(($unscheduledProgramming->assigned_hour/$unscheduledProgramming->contract->weekly_hours)*100).'%';
            }
            else
            $porcentaje='';


        return [
            $unscheduledProgramming->rut,
            $unscheduledProgramming->specialty->specialty_name,
            $unscheduledProgramming->activity_id,
            $unscheduledProgramming->activity->activity_name,
            $unscheduledProgramming->assigned_hour,
            $unscheduledProgramming->hour_performance,
            $unscheduledProgramming->contract->weekly_hours,
            $porcentaje,





        ];
    }

}
