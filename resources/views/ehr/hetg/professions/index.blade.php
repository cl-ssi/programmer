@extends('layouts.app')

@section('title', 'Listado de Especialidades')

@section('content')

<h3 class="mb-3">Listado de Profesiones</h3>

<a class="btn btn-primary mb-3" href="{{ route('ehr.hetg.professions.create') }}">
    <i class="fas fa-plus"></i> Agregar nueva
</a>

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Id</th>
            <th>id_Profession</th>
            <th>Especialidad</th>
            <th>Color</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $professions as $profession )
        <tr>
            <td>{{ $profession->id }}</td>
            <td>{{ $profession->id_profession }}</td>
            <td>{{ $profession->profession_name }}</td>
            <td><span class="badge badge-primary" style="background-color: #{{$profession->color}};">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            <td>
      				<a href="{{ route('ehr.hetg.professions.edit', $profession) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('ehr.hetg.professions.destroy', $profession) }}" class="d-inline">
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
