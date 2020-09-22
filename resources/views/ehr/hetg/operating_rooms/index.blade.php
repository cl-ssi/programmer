@extends('layouts.app')

@section('title', 'Listado de pabellones')

@section('content')

<h3 class="mb-3">Listado de pabellones</h3>

<a class="btn btn-primary mb-3" href="{{ route('ehr.hetg.operating_rooms.create') }}">
    <i class="fas fa-plus"></i> Agregar nuevo
</a>

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            {{-- <th>Establecimiento ID</th> --}}
            <th>Ubicación</th>
            <th>Tipo</th>
            <th>Color</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $operatingRooms as $or )
        <tr>
            <td>{{ $or->id }}</td>
            <td>{{ $or->name }}</td>
            <td>{{ $or->description }}</td>
            {{-- <td>{{ $or->establishment_id }}</td> --}}
            <td>{{ $or->location }}</td>
            @if($or->medic_box == 1)<td>Box médico</td>
            @else <td>Pabellón</td> @endif
            <td><span class="badge badge-primary" style="background-color: #{{$or->color}};">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            <td>
      				<a href="{{ route('ehr.hetg.operating_rooms.edit', $or) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('ehr.hetg.operating_rooms.destroy', $or) }}" class="d-inline">
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
