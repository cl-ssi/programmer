@extends('layouts.ehr')

@section('title', 'Listado de pacientes')

@section('content')

@include('ehr.nav')

@include('ehr.patient.partials.info')

<h3 class="mb-3">Listado de pacientes</h3>

<form class="form-inline float-right" method="GET" action="{{ route('ehr.patient.index') }}">
	<div class="input-group mb-3">

        <div class="input-group-prepend">
            <a class="btn btn-primary" href="{{ route('ehr.patient.create') }}"><i class="fas fa-plus"></i> Nuevo</a>

        </div>

		<input type="text" name="id" class="form-control" placeholder="Buscar RUN o Nombre" value="{{ $searchParam }}" >

		<div class="input-group-append">
			<button class="btn btn-outline-secondary" type="submit">
				<i class="fas fa-search" aria-hidden="true"></i></button>
		</div>

	</div>
</form>

{{ $patients->render() }}

<table class="table table-bordered">
    <thead>
        <tr>
            <th>RUN</th>
            <th>Nombres</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Fecha Nacimiento</th>
            <th>Genero</th>
			<th>Seleccionar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($patients as $patient)
        <tr>
            <td class="text-right">{{ $patient->runFormat() }}</td>
            <td class="text-capitalize">{{ $patient->name }}</td>
            <td class="text-capitalize">{{ $patient->fathers_family }}</td>
            <td class="text-capitalize">{{ $patient->mothers_family }}</td>
            <td class="text-center">{{ $patient->birthDate? $patient->birthDate->format('d-m-Y') : '' }}</td>
            <td>
				@switch($patient->gender)
				    @case('male') Hombre @break
				    @case('female') Mujer @break
					@case('other') Otro @break
					@case('unknown') Desconocido @break
				@endswitch
			</td>
			<td><a href="{{ route('ehr.patient.show', $patient->id) }}"><i class="fas fa-child"></i> Seleccionar</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection
