@extends('layouts.app')

@section('title', 'Reporte de programación')

@section('content')

<h3 class="mb-3">Reporte de Servicios Programados</h3>

<table class="table table-sm table-bordered small text-uppercase">
    <thead>
        <tr>
            <th>Servicio</th>
            <th>Total</th>
            <th>Con Teórico</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($array as $key => $row)
            @if ($row['con_teorico'] != 0)
                <tr style="background-color:#D3F8F8">
            @else
                <tr>
            @endif
                <td>{{$key}}</td>
                <td>{{$row['total']}}</td>
                <td>{{$row['con_teorico']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection
