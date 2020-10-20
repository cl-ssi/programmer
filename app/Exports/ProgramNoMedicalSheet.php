<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromArray;
use App\EHR\HETG\UnscheduledProgramming;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class ProgramNoMedicalSheet implements WithTitle, WithHeadings,  ShouldAutoSize, WithMapping, FromCollection
{


    /**
     * @return Builder
     */


    private $array_programacion_no_medica;

    protected array $arreglo;
    protected $cont=0;


    public function __construct($cutoffdate, array $array_programacion_no_medica)
    {
        $this->cutoffdate = $cutoffdate;
        $this->array_programacion_no_medica = $array_programacion_no_medica;
    }

    public function headings(): array
    {
        return [
            'Rut',
            'Contrato',
            'Especialidad',
            'Actividad',
            'Hrs Asignadas',
              'Rdto/Hr',
              'Rdto/Diario',
              'Rdto/Semanal',
              'Rdto/Mensual',
              'Rdto/Anual',
        ];
    }


    /**
     * @return string
     */
    public function title(): string
    {
        return 'Programación No Médica';
    }


    public function collection()
    {

        foreach ($this->array_programacion_no_medica as $key1 => $value1) {

            foreach ($value1 as $key2 => $value2) {
                foreach ($value2 as $key3 => $value3) {
                    foreach ($value3 as $key4 => $value4) {
                        $this->arreglo[$this->cont][0] = $key1;
                        $this->arreglo[$this->cont][1] = $key2;
                        $this->arreglo[$this->cont][2] = $key3;
                        $this->arreglo[$this->cont][3] = $key4;
                        $this->arreglo[$this->cont][4] = $value4['assigned_hour'];
                        $this->arreglo[$this->cont][5] = $value4['rdto_hour'];
                        $this->arreglo[$this->cont][6] = $value4['assigned_hour']* $value4['rdto_hour'];
                        $this->arreglo[$this->cont][7] = ($value4['assigned_hour']* $value4['rdto_hour'])*7;
                        $this->arreglo[$this->cont][8] = ($value4['assigned_hour']* $value4['rdto_hour'])*7*4;
                        $this->arreglo[$this->cont][9] = ($value4['assigned_hour']* $value4['rdto_hour'])*7*4*52;
                        $this->cont= $this->cont+1;
                    }
                }
            }
        }

        return new Collection([
            $this->arreglo
        ]);
    }

    public function map($unscheduledProgramming): array
    {

        return [
            $unscheduledProgramming[0]

        ];
    }
}
