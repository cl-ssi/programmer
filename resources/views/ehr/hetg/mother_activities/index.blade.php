@extends('layouts.app')

@section('title', 'Listado de Actividades Madre')

@section('content')

<h3 class="mb-3">Listado de Actividades Madre</h3>

<a class="btn btn-primary mb-3" href="{{ route('ehr.hetg.mother_activities.create') }}">
    <i class="fas fa-plus"></i> Agregar nueva
</a>

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Id</th>
            <th>Actividad Madre</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $motherActivities as $MotherActivity )
        <tr>
            <td>{{ $MotherActivity->id }}</td>
            <td>{{ $MotherActivity->description }}</td>
            <td>
      				<a href="{{ route('ehr.hetg.mother_activities.edit', $MotherActivity) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('ehr.hetg.mother_activities.destroy', $MotherActivity) }}" class="d-inline">
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
