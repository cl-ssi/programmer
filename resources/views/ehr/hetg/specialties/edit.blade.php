@extends('layouts.app')

@section('title', 'Editar Especialidad')

@section('content')

<script src="{{ asset('js/colorpicker/jscolor.js') }}"></script>

<h3 class="mb-3">Editar Especialidad</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.specialties.update', $specialty) }}">
    @csrf
    @method('PUT')

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_id_n820">Id n820</label>
            <input type="text" class="form-control" id="for_id_n820" name="id_n820" required value="{{$specialty->id_n820}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_id_sigte">id Sigte</label>
            <input type="text" class="form-control" id="for_id_sigte" placeholder="(opcional)" name="id_sigte" value="{{$specialty->id_sigte}}">
        </fieldset>
    </div>

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_specialty_name">Especialidad</label>
            <input type="text" class="form-control" id="for_specialty_name" placeholder="" name="specialty_name" required value="{{$specialty->specialty_name}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_name">Color</label>
            <input class="form-control jscolor" id="color" name="color" required="" value="{{$specialty->color}}" onchange="update(this.jscolor)">
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')
  <script>
    $( document ).ready(function() {
      document.getElementById("for_name").focus();
    });

    function update(jscolor) {
        // 'jscolor' instance can be used as a string
        document.getElementById('rect').style.backgroundColor = '#' + jscolor
    }
  </script>
@endsection
