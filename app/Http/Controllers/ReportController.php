<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EHR\HETG\Rrhh;

class ReportController extends Controller
{
    //


    public function export()
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

        $callback = function() use ($filas, $columnas)
        {
            $file = fopen('php://output', 'w');
            fputs($file, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            fputcsv($file, $columnas,';');

            foreach($filas as $fila) {
                fputcsv($file, array(                    
                    $fila->rut,
                    $fila->dv,                    
                    $fila->name,
                    $fila->fathers_family,
                    $fila->mothers_family,
                    $fila->job_title                    
                ),';');
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
