@extends('layouts.app')

@section('title', 'Editar Pabellon')

@section('content')

<script src="{{ asset('js/colorpicker/jscolor.js') }}"></script>

<h3 class="mb-3">Editar Pabellon</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.operating_rooms.update', $operatingRoom) }}">
  @csrf
  @method('PUT')

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_name">Nombre</label>
            <input type="text" class="form-control" id="for_name" name="name" required value="{{$operatingRoom->name}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_description">Descripción</label>
            <input type="text" class="form-control" id="for_description" placeholder="Descripción del pabellón" name="description" value="{{$operatingRoom->description}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_location">Ubicación</label>
            <input type="text" class="form-control" id="for_location" placeholder="(opcional)" name="location" value="{{$operatingRoom->location}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_name">Color</label>
            <input class="form-control jscolor" id="color" name="color" required="" value="{{$operatingRoom->color}}" onchange="update(this.jscolor)">
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
