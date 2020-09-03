<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\EHR\HETG\Contract;
use App\EHR\HETG\Rrhh;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RrhhSheet implements FromCollection, WithTitle, WithHeadings, WithMapping, ShouldAutoSize
{


    /**
     * @return Builder
     */

    public function headings(): array
    {
        return [
            'ID_DEIS',
            'Cod_Estab SIRH',
            'RUT_TIT',
            'DV_TIT',
            'Grupo de Riesgo (SI/NO)',
            'Ausentismo (SI/NO)',
            'Motivo (maternales, PSGS, Comisiones de estudio)',
            'RUT Programable',            
            'DV',
            'Nombre',
            'LEY',
            'Correlativo Contrato',
            'Titulo Profesional',
            'Especialidad SIS',
            'Hrs Semanales contratadas',
            'Sistema de Turno (S/N)',
            'Observaciones debe Identificar (Liberado de Guardia (LG)/Periodo Asistencial Obligatorio(PAO))',
            'Feriados Legales',
            'Dias Descanso Compensatorio (Ley Urgencia)',
            'Dias de Permisos Administrativos',
            'Dias de Congreso o capacitación',
            'Tiempo de Lactancia semanal (min)',
            'Tiempo de colación semanal (min)',
            'Tiempo de permiso gremial  semanal (min)',
            'Fecha Inicio contrato (AAAAMMDD)',
            'Fecha termino contrato (AAAAMMDD)',
            'MATRIZ',
        ];
    }




    public function collection()
    {
        return Contract::all();
        //return Rrhh::all();
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
            $contract->rrhh->id_deis,
            $contract->rrhh->cod_estab_sirh,
            $contract->rrhh->rut,
            $contract->rrhh->dv,
            $contract->rrhh->risk_group,
            $contract->rrhh->missing_condition,
            $contract->rrhh->missing_reason,
            $contract->rrhh->rut,
            $contract->rrhh->dv,
            $contract->rrhh->fullname,
            $contract->law,
            $contract->contract_id,
            $contract->rrhh->job_title,
            'falta este atributo',
            $contract->weekly_hours,
            $contract->shift_system,
            $contract->obs,
            $contract->legal_holidays,
            $contract->compensatory_rest,
            $contract->administrative_permit,
            $contract->training_days,
            $contract->breastfeeding_time,
            $contract->weekly_collation,
            'falta este atributo',
            $contract->contract_start_date,
            $contract->contract_end_date,
            'falta este atribudo',

            
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
