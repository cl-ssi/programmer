@extends('layouts.app')

@section('title', 'Reporte de programación')

@section('content')

<h3 class="mb-3">Reporte de especialidades programadas</h3>

<table class="table table-sm table-bordered small text-uppercase">
    <thead>
        <tr>
            <th>Especialidad</th>
            <th>Total</th>
            <th>Con Teórico</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($array as $key => $rrhh)
            <tr>
                <td>{{$key}}</td>
                <td>{{$rrhh['total']}}</td>
                <td>{{$rrhh['con_teorico']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection
