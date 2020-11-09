@extends('layouts.app')

@section('title', 'Listado de Servicios')

@section('content')

<h3 class="mb-3">Listado de Servicios</h3>

<a class="btn btn-primary mb-3" href="{{ route('ehr.hetg.services.create') }}">
    <i class="fas fa-plus"></i> Agregar nueva
</a>

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Id</th>
            <th>Servicio</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $services as $service )
        <tr>
            <td>{{ $service->id }}</td>
            <td>{{ $service->service_name }}</td>
            <td>
      				<a href="{{ route('ehr.hetg.services.edit', $service) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('ehr.hetg.services.destroy', $service) }}" class="d-inline">
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
