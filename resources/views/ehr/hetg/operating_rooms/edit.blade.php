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
            <label for="for_medic_box">Tipo</label>
            <select name="medic_box" id="for_medic_box" class="form-control">
              <option value="0" {{ $operatingRoom->medic_box == 0 ? 'selected' : '' }}>Pabellón</option>
              <option value="1" {{ $operatingRoom->medic_box == 1 ? 'selected' : '' }}>Box médico</option>
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_name">Color</label>
            <input class="form-control jscolor" id="color" name="color" required="" value="{{$operatingRoom->color}}" onchange="update(this.jscolor)">
        </fieldset>
    </div>

    <div class="row">

        <fieldset class="form-group col">
            <label for="for_name">Especialidades</label><br>
            <select class="selectpicker" name="specialties[]" multiple>
                @foreach ($specialties as $key => $specialty)
                  @if($operatingRoom->specialties != null)
                    <option value="{{$specialty->id}}" {{ ($operatingRoom->specialties->contains('id', $specialty->id))?'selected':'' }}>{{$specialty->specialty_name}}</option>
                  @else
                    <option value="{{$specialty->id}}" >{{$specialty->specialty_name}}</option>
                  @endif
                @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_name">Profesiones</label><br>
            <select class="selectpicker" name="professions[]" multiple>
                @foreach ($professions as $key => $profession)
                  @if($operatingRoom->professions != null)
                    <option value="{{$profession->id}}" {{ ($operatingRoom->professions->contains('id', $profession->id))?'selected':'' }}>{{$profession->profession_name}}</option>
                  @else
                    <option value="{{$profession->id}}" >{{$profession->profession_name}}</option>
                  @endif
                @endforeach
            </select>
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@canany(['administrador'])
    <br /><hr />
    <div style="height: 300px; overflow-y: scroll;">
        @include('partials.audit', ['audits' => $operatingRoom->audits] )
    </div>
@endcanany

@endsection

@section('custom_js')

<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

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
