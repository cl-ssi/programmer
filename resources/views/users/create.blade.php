@extends('layouts.app')

@section('title', 'Nuevo Usuario')

@section('content')

@include('parameters.nav')

<h3 class="mb-3">Nuevo Usuario</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" class="form-horizontal" action="{{ route('users.store') }}">
    @csrf
    @method('POST')
    <div class="card mb-3">
        <div class="card-body">
            <div class="form-row">

                <fieldset class="form-group col-8 col-md-2">
                    <label for="for_run">Run *</label>
                    <input type="number" class="form-control" name="id" id="for_id" required autocomplete="off">
                </fieldset>

                <fieldset class="form-group col-4 col-md-1">
                    <label for="for_dv">DV *</label>
                    <input type="text" class="form-control" name="dv" id="for_dv" required>
                </fieldset>

                <fieldset class="form-group col-12 col-md-3">
                    <label for="for_name">Nombre y Apellido *</label>
                    <input type="text" class="form-control" name="name" id="for_name"
                        required autocomplete="off">
                </fieldset>

                <fieldset class="form-group col-12 col-md-3">
                    <label for="for_email">Email *</label>
                    <input type="email" class="form-control" name="email" id="for_email"
                        style="text-transform: lowercase;"
                        autocomplete="off">
                </fieldset>

                <fieldset class="form-group col-12 col-md-2">
                    <label for="for_password">Clave *</label>
                    <input type="password" class="form-control" name="password" id="for_password"
                        autocomplete="off" required>
                </fieldset>

            </div>
      </div>
  </div>

  <hr />

    <div class="container">
      <div class="row">
        <div class="col-sm">
            <h4>Roles</h4>
            <select class="selectpicker" name="roles[]" multiple>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm">
            <h4>Permisos</h4>
            <select class="selectpicker" name="permissions[]" multiple>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
      </div>
    </div>

    <br />

    <!-- <div class="container">
      <div class="row">
        <div class="col-sm">
            <h4>Servicios</h4>
            <select id="services" class="selectpicker" name="services[]" multiple>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm">
            <h4>Servicio Principal</h4>
            <select id="principal_service" name="principal_service">

            </select>
        </div>


      </div>
    </div>

    <br> -->

    <div class="container">
      <div class="row">
        <div class="col-sm">
            <h4>Especialidades</h4>
            <select id="specialties" class="selectpicker" name="specialties[]" multiple>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}" >{{ $specialty->specialty_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm">
            <h4>Especialidad Principal</h4>
            <select id="principal_specialty" name="principal_specialty">

            </select>
        </div>


      </div>
    </div>

    <br>

    <div class="container">
      <div class="row">
        <div class="col-sm">
            <h4>Profesiones</h4>
            <select id="professions" class="selectpicker" name="professions[]" multiple>
                @foreach($professions as $profession)
                    <option value="{{ $profession->id }}">{{ $profession->profession_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm">
            <h4>Profesión Principal</h4>
            <select id="principal_profession" name="principal_profession">

            </select>
        </div>
      </div>
    </div>

    <br />

    <div class="container">
      <div class="row">
        <div class="col-sm">
            <h4>Box</h4>
            <select class="selectpicker" name="operating_rooms[]" multiple>
                @foreach($operating_rooms as $operating_room)
                    <option value="{{ $operating_room->id }}">{{ $operating_room->description }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm">

        </div>
      </div>
    </div>



    <button type="submit" class="btn btn-primary mt-3">Guardar</button>


</form>



@endsection

@section('custom_js')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">

<script src='{{asset("js/jquery.rut.chileno.js")}}'></script>
<script type="text/javascript">

$(document).ready(function(){

  //especialidades
  //al modificar especialidades
  $('#services').on('change', function() {
    $('#principal_service').empty();
    $.each($("#services option:selected"), function(){
        optionText = $(this).text();
        optionValue = $(this).val();
        $('#principal_service').append('<option value="'+optionValue+'">'+optionText+'</option>');
    });
  });


  //especialidades
  //al modificar especialidades
  $('#specialties').on('change', function() {
    $('#principal_specialty').empty();
    $.each($("#specialties option:selected"), function(){
        optionText = $(this).text();
        optionValue = $(this).val();
        $('#principal_specialty').append('<option value="'+optionValue+'">'+optionText+'</option>');
    });

  });


  //profesiones
  //al modificar especialidades
  $('#professions').on('change', function() {
    $('#principal_profession').empty();
    $.each($("#professions option:selected"), function(){
        optionText = $(this).text();
        optionValue = $(this).val();
        $('#principal_profession').append('<option value="'+optionValue+'">'+optionText+'</option>');
    });
  });

});

</script>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/defaults-es_CL.min.js') }}"></script>

@endsection
