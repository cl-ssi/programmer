@extends('layouts.app')

@section('title', 'Reporte de programación')

@section('content')

<h3 class="mb-3">Reporte de Profesionales Programados</h3>

<table class="table table-sm table-bordered small text-uppercase" style="width:50%;">
    <tbody>
        <tr>
            <td>Filtro</td>
            <td>
              <form method="GET" id="form" class="form-horizontal" action="{{ route('ehr.hetg.theoretical_programming.programed_professionals') }}">
                <select name="filter" onchange="this.form.submit()">
                  <option value="0" {{ $request->filter == 0 ? 'selected' : '' }}>Todos</option>
                  <option value="1" {{ $request->filter == 1 ? 'selected' : '' }}>Con teórico</option>
                  <option value="2" {{ $request->filter == 2 ? 'selected' : '' }}>Sin teórico</option>
                </select>
              </form>
            </td>
        </tr>
    </tbody>
</table>

<table class="table table-sm table-bordered small text-uppercase" style="width:50%;">
    <tbody>
        <tr>
            <td>Total</td>
            <td><b>{{$total}}</b></td>
        </tr>
        <tr>
            <td>Con teórico</td>
            <td><b>{{$total_with_theorical}}</b></td>
        </tr>
        <tr>
            <td>Sin teórico</td>
            <td><b>{{$total_withnot_theorical}}</b></td>
        </tr>
    </tbody>
</table>

<table class="table table-sm table-bordered small text-uppercase">
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
