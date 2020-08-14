@extends('layouts.ehr')

@section('title', 'Ver Paciente')

@section('content')

@include('ehr.nav')

@include('ehr.patient.partials.info')

<h3 class="mb-3">Ver Paciente</h3>

<div class="shadow-sm p-3 mb-5 bg-white rounded">
    <strong>RUN:</strong> {{ $patient->run() }} <br>
    <strong>Nombre:</strong> <span class="text-capitalize">{{ $patient->fullName() }}</span> <br>
    <strong>Genero:</strong>
    @switch($patient->gender)
        @case('male') Hombre @break
        @case('female') Mujer @break
        @case('other') Otro @break
        @case('unknown') Desconocido @break
    @endswitch
    <br>
    <strong>Fecha Nacimiento:</strong> {{ $patient->birthDate? $patient->birthDate->format('d-m-Y'):'' }} <br>
    <strong>Nacionalidad:</strong> {{ $patient->nationality }} <br>
    <a href="{{ route('ehr.patient.edit', $patient)}}"> <i class="fas fa-edit"></i> Edit</a>
</div>


@endsection

@section('custom_js')

@endsection
