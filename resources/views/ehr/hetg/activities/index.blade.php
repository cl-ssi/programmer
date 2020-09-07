@extends('layouts.app')

@section('title', 'Listado de Actividades')

@section('content')

<h3 class="mb-3">Listado de Actividades</h3>

<a class="btn btn-primary mb-3" href="{{ route('ehr.hetg.activities.create') }}">
    <i class="fas fa-plus"></i> Agregar nueva
</a>

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>id_actividad</th>
            <th>Actvidad Madre</th>
            <th>Tipo de actividad</th>
            <th>Especialidad</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $activities as $activity )
        <tr>
            <td>{{ $activity->id_activity }}</td>
            <td>@if($activity->motherActivity){{ $activity->motherActivity->description }}@endif</td>
            <td>@if($activity->activityType){{ $activity->activityType->name }}@endif</td>
            <td>{{ $activity->activity_name }}</td>
            <td>
      				<a href="{{ route('ehr.hetg.activities.edit', $activity) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('ehr.hetg.activities.destroy', $activity) }}" class="d-inline">
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
