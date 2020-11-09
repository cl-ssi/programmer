@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')

@include('parameters.nav')

<h3 class="mb-3">Editar Usuario</h3>

<form method="POST" class="form-horizontal" action="{{ route('users.update',$user) }}">
    @csrf
    @method('PUT')
    <div class="card mb-3">
        <div class="card-body">

            <div class="form-row">

                <fieldset class="form-group col-8 col-md-2">
                    <label for="for_run">Run</label>
                    <input type="number" class="form-control" name="id" id="for_id"
                        value="{{ $user->id }}" disabled>
                </fieldset>

                <fieldset class="form-group col-4 col-md-1">
                    <label for="for_dv">Dv</label>
                    <input type="text" class="form-control" name="dv" id="for_dv"
                        value="{{ $user->dv }}" disabled>
                </fieldset>

                <fieldset class="form-group col-12 col-md-3">
                    <label for="for_name">Nombre y Apellido</label>
                    <input type="text" class="form-control" name="name" id="for_name"
                        value="{{ $user->name }}" required>
                </fieldset>

                <fieldset class="form-group col-12 col-md-3">
                    <label for="for_email">Email</label>
                    <input type="email" class="form-control" name="email" id="for_email"
                        value="{{ $user->email }}" style="text-transform: lowercase;">
                </fieldset>

            </div>

            <div class="form-row">
                <fieldset class="form-group col-6 col-md-6">
                    <a class="btn btn-primary btn-sm" href="{{ route('users.password.restore', $user) }}">
                        <i class="fas fa-plus"></i> Generar Nueva Contraseña
                    </a>
                </fieldset>
            </div>

        </div>
    </div>

    <hr>

    <div class="container">
      <div class="row">
        <div class="col-sm">
            <h4>Roles</h4>
            <select class="selectpicker" name="roles[]" multiple>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ ($user->hasRole($role->name))?'selected':'' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm">
            <h4>Permisos</h4>
            <select class="selectpicker" name="permissions[]" multiple>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}" {{ ($user->hasPermissionTo($permission->name))?'selected':'' }}>{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
      </div>
    </div>

    <br />

    <div class="container">
      <div class="row">
        <div class="col-sm">
            <h4>Servicios</h4>
            <select id="services" class="selectpicker" name="services[]" multiple>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ ($user->services->contains('id', $service->id))?'selected':'' }}>{{ $service->service_name }}</option>
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

    <br>

    <div class="container">
      <div class="row">
        <div class="col-sm">
            <h4>Especialidades</h4>
            <select id="specialties" class="selectpicker" name="specialties[]" multiple>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ ($user->specialties->contains('id', $specialty->id))?'selected':'' }}>{{ $specialty->specialty_name }}</option>
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
                    <option value="{{ $profession->id }}" {{ ($user->professions->contains('id', $profession->id))?'selected':'' }}>{{ $profession->profession_name }}</option>
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
                    <option value="{{ $operating_room->id }}" {{ ($user->userOperatingRooms->contains('operating_room_id', $operating_room->id))?'selected':'' }}>{{ $operating_room->description }}</option>
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

<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/defaults-es_CL.min.js') }}"></script>

<script>

$(document).ready(function(){

  //especialidades

  //cuando carga la hoja
  @foreach($user->userServices as $userService)
    @if($userService->principal == 1)
      $('#principal_service').append('<option selected value="'+{{$userService->service->id}}+'">'+'{{$userService->service->service_name}}'+'</option>');
    @else
      $('#principal_service').append('<option value="'+{{$userService->service->id}}+'">'+'{{$userService->service->service_name}}'+'</option>');
    @endif
  @endforeach

  //al modificar especialidades
  $('#services').on('change', function() {
    $('#principal_service').empty();
    $.each($("#services option:selected"), function(){
        optionText = $(this).text();
        optionValue = $(this).val();
        $('#principal_service').append('<option value="'+optionValue+'">'+optionText+'</option>');
    });

    //selecciona la opción principal
    @if($user->userServices->count() > 0)
      @foreach($user->userServices as $userService)
        if({{$userService->principal}} == 1){
          $("#principal_service option[value='{{$userService->service->id}}']").attr("selected", true);
        }
      @endforeach
    @endif
  });


  //especialidades

  //cuando carga la hoja
  @foreach($user->userSpecialties as $userSpecialty)
    @if($userSpecialty->principal == 1)
      $('#principal_specialty').append('<option selected value="'+{{$userSpecialty->specialty->id}}+'">'+'{{$userSpecialty->specialty->specialty_name}}'+'</option>');
    @else
      $('#principal_specialty').append('<option value="'+{{$userSpecialty->specialty->id}}+'">'+'{{$userSpecialty->specialty->specialty_name}}'+'</option>');
    @endif
  @endforeach

  //al modificar especialidades
  $('#specialties').on('change', function() {
    $('#principal_specialty').empty();
    $.each($("#specialties option:selected"), function(){
        optionText = $(this).text();
        optionValue = $(this).val();
        $('#principal_specialty').append('<option value="'+optionValue+'">'+optionText+'</option>');
    });

    //selecciona la opción principal
    @if($user->userSpecialties->count() > 0)
      @foreach($user->userSpecialties as $userSpecialty)
        if({{$userSpecialty->principal}} == 1){
          $("#principal_specialty option[value='{{$userSpecialty->specialty->id}}']").attr("selected", true);
        }
      @endforeach
    @endif
  });


  //profesiones

  @foreach($user->userProfessions as $userProfession)
    @if($userProfession->principal == 1)
      $('#principal_profession').append('<option selected value="'+{{$userProfession->profession->id}}+'">'+'{{$userProfession->profession->profession_name}}'+'</option>');
    @else
      $('#principal_profession').append('<option value="'+{{$userProfession->profession->id}}+'">'+'{{$userProfession->profession->profession_name}}'+'</option>');
    @endif
  @endforeach

  //al modificar especialidades
  $('#professions').on('change', function() {
    $('#principal_profession').empty();
    $.each($("#professions option:selected"), function(){
        optionText = $(this).text();
        optionValue = $(this).val();
        $('#principal_profession').append('<option value="'+optionValue+'">'+optionText+'</option>');
    });

    //selecciona la opción principal
    @if($user->userProfessions->count() > 0)
      @foreach($user->userProfessions as $userProfession)
        if({{$userProfession->principal}} == 1){
          $("#principal_profession option[value='{{$userProfession->profession->id}}']").attr("selected", true);
        }
      @endforeach
    @endif
  });

});

</script>

@endsection
