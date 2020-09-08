@extends('layouts.app')

@section('title', 'Listado de Fechas de corte')

@section('content')

<h3 class="mb-3">Listado de Fechas de corte</h3>

<a class="btn btn-primary mb-3" href="{{ route('ehr.hetg.cutoffdates.create') }}">
    <i class="fas fa-plus"></i> Agregar nueva
</a>

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Observación</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $cutoffdates as $cutoffdate )
        <tr>
            <td>{{ $cutoffdate->id }}</td>
            <td>{{ $cutoffdate->date }}</td>
            <td>{{ $cutoffdate->observation }}</td>
            <td>
      				<a href="{{ route('ehr.hetg.cutoffdates.edit', $cutoffdate) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('ehr.hetg.cutoffdates.destroy', $cutoffdate) }}" class="d-inline">
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
