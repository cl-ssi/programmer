@extends('layouts.app')

@section('title', 'Listado de programación')

@section('content')
<h3 class="mb-3">Listado de programación</h3>

<a class="btn btn-primary mb-3" href="{{ route('ehr.hetg.medical_programming.create') }}">
    <i class="fas fa-plus"></i> Agregar nueva
</a>

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Id contrato</th>
            <th>Especialista</th>
            <th>Especialidad</th>
            <th>Actividad</th>
            <th>Horas Asignadas</th>
            <th>Horas Performance</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $programming as $row )
        <tr>
            <td>{{ $row->contract->contract_id }}</td>
            <td>{{ $row->rrhh->getFullNameAttribute() }}</td>
            <td>{{ $row->specialty->specialty_name }}</td>
            <td>{{ $row->activity->activity_name }}</td>
            <td>{{ $row->assigned_hour }}</td>
            <td>{{ $row->hour_performance }}</td>
            <td nowrap>
      				<a href="{{ route('ehr.hetg.medical_programming.edit', $row) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('ehr.hetg.medical_programming.destroy', $row) }}" class="d-inline">
      					@csrf
      					@method('DELETE')
      					<button type="submit" class="btn btn-outline-secondary btn-sm" onclick="return confirm('¿Está seguro de eliminar la información?');">
      						<span class="fas fa-trash-alt" aria-hidden="true"></span>
      					</button>
      				</form>
      			</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection
