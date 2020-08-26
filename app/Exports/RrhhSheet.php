<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\EHR\HETG\Contract;

class RrhhSheet implements FromCollection, WithTitle, WithHeadings, WithMapping
{
    

    /**
     * @return Builder
     */

    public function headings(): array
    {
        return [
          'Rut',
          'Nombre',
          'Ley',
          'Correlativo Contrato',
          'Título Profesional',
          'Hrs Semanales Contratadas',
          'Sistema de Turno (S/N)',
          'Observaciones debe Identificar (Liberado de Guardia (LG)/Periodo Asistencial Obligatorio(PAO)/ Permiso Gremial)',
        ];
    }




    public function collection()
    {
        return Contract::all();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'RRHH';
    }


    public function map($contract): array
    {
        return [
            $contract->rut,
            $contract->rrhh->fathers_family.' '.$contract->rrhh->mothers_family.' '.$contract->rrhh->name,
            $contract->law,
            $contract->contract_id,
            $contract->rrhh->job_title,
            $contract->weekly_hours,
            $contract->shift_system,
            $contract->obs,
            //Date::dateTimeToExcel($invoice->created_at),
        ];
    }

}