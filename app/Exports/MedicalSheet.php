<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\EHR\HETG\MedicalProgramming;

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
        return MedicalProgramming::all();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Programación Médica';
    }


    public function map($medicalprogramming): array
    {
        if($medicalprogramming->hour_performance)
            {
               $porcentaje=round(($medicalprogramming->assigned_hour/$medicalprogramming->contract->weekly_hours)*100).'%';
            }
            else
            $porcentaje='';


        return [
            $medicalprogramming->rut,
            $medicalprogramming->specialty->specialty_name,
            $medicalprogramming->activity_id,
            $medicalprogramming->activity->activity_name,            
            $medicalprogramming->assigned_hour,
            $medicalprogramming->hour_performance,
            $medicalprogramming->contract->weekly_hours,
            $porcentaje,
            
            

            
            
        ];
    }

}