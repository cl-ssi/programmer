@extends('layouts.app')

@section('title', 'Nueva Especialidad')

@section('content')

<script src="{{ asset('js/colorpicker/jscolor.js') }}"></script>

<h3 class="mb-3">Nueva Profesión</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.professions.store') }}">
    @csrf
    @method('POST')

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_id_profession">id_Profession</label>
            <input type="text" class="form-control" id="for_id_profession" name="id_profession" required>
        </fieldset>

        {{-- <fieldset class="form-group col">
            <label for="for_id_sigte">id Sigte</label>
            <input type="text" class="form-control" id="for_id_sigte" placeholder="(opcional)" name="id_sigte">
        </fieldset> --}}
    </div>

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_profession_name">Profesión</label>
            <input type="text" class="form-control" id="for_profession_name" placeholder="" name="profession_name" required>
        </fieldset>

        <fieldset class="form-group col-4">
            <label for="for_name">Color</label>
            <input class="form-control jscolor" name="color" value="ab2567" required="">
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

@endsection
