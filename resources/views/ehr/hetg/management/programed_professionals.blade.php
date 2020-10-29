@extends('layouts.app')

@section('title', 'Reporte de programación')

@section('content')

<h3 class="mb-3">Reporte de programación</h3>

{{-- <table class="table table-sm table-borderer"> --}}
<table class="table table-sm table-bordered small text-uppercase" id="tabla_casos">
    <thead>
        <tr>
            <th>Profesional</th>
            <th>Especialidad</th>
            <th>Teórico</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($array as $key => $rrhh)
            @foreach ($rrhh as $key2 => $prof)
                @if ($prof['cant'] == "Sí")
                    <tr style="background-color:#D3F8F8">
                @else
                    <tr>
                @endif

                    <td>{{$key}}</td>
                    <td>{{$key2}}</td>
                    <td>{{$prof['cant']}}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection
