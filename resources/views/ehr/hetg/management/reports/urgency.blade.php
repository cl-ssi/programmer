@extends('layouts.app')

@section('title', 'Reporte por Urgencia')

@section('content')
<h3 class="mb-3">Reporte por Urgencia</h3>

<div class="row">
    <div class="col-3">
        <h4>Por especialidad</h4>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Nombre Funcionario</th>
                    <th>Horas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resumen_por_especialidad as $especialidad)
                <tr>
                    <td>{{ $especialidad['nombre'] }}</td>
                    <td class="text-center">{{ $especialidad['horas'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-8">
        <h4>Por funcionario</h4>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Nombre Funcionario</th>
                    <th>Especialidad</th>
                    <th>Hrs. Ejec.</th>
                    <th>Hrs. Contrato</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resumen as $usuario)
                @if($usuario['nombre_especialidad'] != '')
                <tr>
                    <td>{{ $usuario['nombre'] }}</td>
                    <td>{{ $usuario['nombre_especialidad'] }}</td>
                    <td class="text-center">{{ $usuario['horas_ejecutadas'] }}</td>
                    <td class="text-center">{{ $usuario['horas_programadas'] }}</td>
                </tr>
                @endif
                @endforeach

                @foreach($resumen as $usuario)
                @if($usuario['nombre_especialidad'] == '')
                <tr>
                    <td>{{ $usuario['nombre'] }}</td>
                    <td>{{ $usuario['nombre_especialidad'] }}</td>
                    <td class="text-center">{{ $usuario['horas_ejecutadas'] }}</td>
                    <td class="text-center">{{ $usuario['horas_programadas'] }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>





@endsection

@section('custom_js')

@endsection
