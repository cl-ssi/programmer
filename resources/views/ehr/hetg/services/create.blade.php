@extends('layouts.app')

@section('title', 'Nuevo Servicio')

@section('content')

<h3 class="mb-3">Nuevo Servicio</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.services.store') }}">
    @csrf
    @method('POST')

    <div class="row">

        <fieldset class="form-group col">
            <label for="for_service_code">Código de Servicio</label>
            <input type="text" class="form-control" id="for_service_code" placeholder="" name="service_code" required>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_description">Servicio</label>
            <input type="text" class="form-control" id="for_service_name" placeholder="" name="service_name" required>
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

@endsection
