@extends('layouts.app')

@section('title', 'Listado de Especialidades')

@section('content')

<h3 class="mb-3">Listado de Especialidades</h3>

<a class="btn btn-primary mb-3" href="{{ route('ehr.hetg.specialties.create') }}">
    <i class="fas fa-plus"></i> Agregar nueva
</a>

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Id</th>
            <th>id_especialidad</th>
            <th>id Sigte</th>
            <th>Especialidad</th>
            <th>Color</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $specialties as $specialty )
        <tr>
            <td>{{ $specialty->id }}</td>
            <td>{{ $specialty->id_specialty }}</td>
            <td>{{ $specialty->id_sigte }}</td>
            <td>{{ $specialty->specialty_name }}</td>
            <td><span class="badge badge-primary" style="background-color: #{{$specialty->color}};">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            <td>
      				<a href="{{ route('ehr.hetg.specialties.edit', $specialty) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('ehr.hetg.specialties.destroy', $specialty) }}" class="d-inline">
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
