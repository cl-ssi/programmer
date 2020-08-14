@extends('layouts.app')

@section('title', 'Nuevo Pabellon')

@section('content')

<script src="{{ asset('js/colorpicker/jscolor.js') }}"></script>

<h3 class="mb-3">Nuevo Pabellon</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.operating_rooms.store') }}">
    @csrf
    @method('POST')

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_name">Nombre</label>
            <input type="text" class="form-control" id="for_name" name="name" required>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_description">Descripción</label>
            <input type="text" class="form-control" id="for_description" placeholder="Descripción del pabellón" name="description">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_location">Ubicación</label>
            <input type="text" class="form-control" id="for_location" placeholder="(opcional)" name="location">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_name">Color</label>
            <input class="form-control jscolor" name="color" value="ab2567" required="">
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

@endsection
