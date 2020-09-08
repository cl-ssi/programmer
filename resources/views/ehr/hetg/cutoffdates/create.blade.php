@extends('layouts.app')

@section('title', 'Nueva Fecha de corte')

@section('content')

<h3 class="mb-3">Nueva Fecha de corte</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.cutoffdates.store') }}">
    @csrf
    @method('POST')

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_description">Fecha</label>
            {{-- <input type="text" class="form-control" id="for_description" placeholder="" name="description" required> --}}
            <input name="date" class="form-control" type="date">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_observation">Observación</label>
            <input type="text" class="form-control" id="for_observation" placeholder="" name="observation" required>
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

@endsection
