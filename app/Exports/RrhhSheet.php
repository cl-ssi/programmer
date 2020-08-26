<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\EHR\HETG\Contract;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RrhhSheet implements FromCollection, WithTitle, WithHeadings, WithMapping, ShouldAutoSize
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
          'Feriados Legales',
          'Días Descanso Compensatorio (Ley Urgencia)',
          'Días de Permisos Administrativos',
          'Días de Congreso o Capacitación',
          'Tiempo de Lactancia Semanal (min)',
          'Tiempo de colación semanal (min)',
          'Fecha de Inicio de Contrato',
          'Fecha de Termino de Contrato',
          'Servicio/Unidad',
          'Cod_Unidad',
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
            $contract->legal_holidays,
            $contract->compensatory_rest,
            $contract->administrative_permit,
            $contract->training_days,            
            $contract->breastfeeding_time,
            $contract->weekly_collation,
            $contract->contract_start_date,
            $contract->contract_end_date,
            $contract->unit,
            $contract->unit_code,
            //Date::dateTimeToExcel($invoice->created_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            // 'A' => NumberFormat::FORMAT_GENERAL,
            // 'B' => NumberFormat::FORMAT_GENERAL,            
            //'F' => 11.67,
        ];
    }

}