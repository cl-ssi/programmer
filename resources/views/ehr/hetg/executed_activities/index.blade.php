@extends('layouts.app')

@section('title', 'Listado de actividades ejecutadas')

@section('content')
<h3 class="mb-3">Listado de actividades ejecutadas</h3>

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Pabellon</th>
            <th>Profesion</th>
            <th>Rut Médico</th>
            <th>Nombre médico</th>
            <th>Especialidad</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $executedActivities as $activity )
        <tr>
            <td>{{ $activity->pabellon }}</td>
            <td>{{ $activity->profesion }}</td>
            <td>{{ $activity->medic_rut }}</td>
            <td>{{ $activity->medico_nombre }}</td>
            <td>{{ $activity->medic_specialty_desc }}</td>
            <td>{{ $activity->estado_intervencion_desc }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection
