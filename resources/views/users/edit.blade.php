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
            <h4>Especialidades</h4>
            <select class="selectpicker" name="specialties[]" multiple>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ ($user->userSpecialties->contains('specialty_id', $specialty->id))?'selected':'' }}>{{ $specialty->specialty_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm">
            <h4>Profesiones</h4>
            <select class="selectpicker" name="professions[]" multiple>
                @foreach($professions as $profession)
                    <option value="{{ $profession->id }}" {{ ($user->userProfessions->contains('profession_id', $profession->id))?'selected':'' }}>{{ $profession->profession_name }}</option>
                @endforeach
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

@endsection
