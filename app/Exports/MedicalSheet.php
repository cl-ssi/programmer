<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\EHR\HETG\MedicalProgramming;

class MedicalSheet implements FromCollection, WithTitle, WithHeadings, WithMapping
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
        return [
            $medicalprogramming->rut,
            //$medicalprogramming->speciality_id,
            $medicalprogramming->specialty->specialty_name,
            //Date::dateTimeToExcel($invoice->created_at),
        ];
    }

}