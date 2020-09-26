<?php

namespace App\Exports;

use App\EHR\HETG\Contract;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping,
    WithMultipleSheets,
    WithColumnFormatting,
    ShouldAutoSize
};

//use App\Exports\RrhhSheet;


class ReportExportCut implements FromCollection, WithMapping, WithMultipleSheets
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    private $cutoffdate;
    private $array_programacion_medica;
    private $array_programacion_no_medica;


    public function __construct($cutoffdate, array $array_programacion_medica, array $array_programacion_no_medica)
    {
        $this->cutoffdate = $cutoffdate;
        $this->array_programacion_medica = $array_programacion_medica;
        $this->array_programacion_no_medica = $array_programacion_no_medica;
    }

    public function collection()
    {
        return Contract::all();
    }


    public function sheets(): array
    {
        $sheets = [];
        $sheets[0] = new RrhhSheet();
        $sheets[1] = new ProgramMedicalSheet($this->cutoffdate, $this->array_programacion_medica);
        $sheets[2] = new ProgramNoMedicalSheet($this->cutoffdate, $this->array_programacion_no_medica);
        return $sheets;
    }





    public function map($contract): array
    {
        return [
            $contract->rut,
            $contract->rrhh->fathers_family . ' ' . $contract->rrhh->mothers_family . ' ' . $contract->rrhh->name,
            $contract->law,
            $contract->contract_id,
            $contract->rrhh->job_title,
            $contract->rrhh->weekly_hours,
            //Date::dateTimeToExcel($invoice->created_at),
        ];
    }
}
