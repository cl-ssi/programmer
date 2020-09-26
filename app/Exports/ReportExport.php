<?php

namespace App\Exports;

use App\EHR\HETG\Contract;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings, WithMapping, WithMultipleSheets,
    WithColumnFormatting, ShouldAutoSize};

use App\Exports\RrhhSheet;


class ReportExport implements FromCollection, WithMapping, WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;


    
    public function collection()
    {
        return Contract::all();
    }


    public function sheets(): array
    {
        $sheets = [];

        //for ($month = 1; $month <= 12; $month++) {
            $sheets[0] = new RrhhSheet();
            $sheets[1] = new MedicalSheet();
        //}

        return $sheets;
    }



    

    public function map($contract): array
    {
        return [
            $contract->rut,
            $contract->rrhh->fathers_family.' '.$contract->rrhh->mothers_family.' '.$contract->rrhh->name,
            $contract->law,
            $contract->contract_id,
            $contract->rrhh->job_title,
            $contract->rrhh->weekly_hours,
            //Date::dateTimeToExcel($invoice->created_at),
        ];
    }


    


    
}
