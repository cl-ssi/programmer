@extends('layouts.app')

@section('title', 'Crear RRHH')

@section('content')

<h3 class="mb-3">Crear RRHH</h3>

<form method="POST" class="form-horizontal" action="{{ route('rrhh.rrhh.store') }}">
    @csrf
    @method('POST')

    <div class="row">
        <fieldset class="form-group col-4">
            <input type="checkbox" name="user_create" id="user_create" checked> Crear como usuario
        </fieldset>
    </div>

    <div class="row">

        <fieldset class="form-group col-8 col-md-2">
            <label for="for_id_deis">Id Deis</label>
            <input type="number" class="form-control" name="id_deis" id="for_id_deis">
        </fieldset>

        <fieldset class="form-group col-8 col-md-2">
            <label for="for_cod_estab_sirh">Cod Estab SIRH</label>
            <input type="number" class="form-control" name="cod_estab_sirh" id="for_cod_estab_sirh">
        </fieldset>

        <fieldset class="form-group col-3">
            <label for="for_barcode">Rut</label>
            <input type="text" class="form-control" id="for_rut" placeholder="Rut" name="rut" required="">
        </fieldset>

        <fieldset class="form-group col-1">
            <label for="for_dv">Dv</label>
            <input type="text" class="form-control" id="for_dv" placeholder="Dv" name="dv" required="">
        </fieldset>

    </div>

    <div class="row">

        <fieldset class="form-group col">
            <label for="risk_group">Grupo de riesgo</label>
            <select name="risk_group" id="for_risk_group" class="form-control">
              <option value="1">Sí</option>
              <option value="0">No</option>
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_missing_condition">Ausentismo</label>
            <select name="missing_condition" id="for_missing_condition" class="form-control">
              <option value="1">Sí</option>
              <option value="0">No</option>
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_missing_reason">Motivo</label>
            <input type="text" class="form-control" id="for_missing_reason" name="missing_reason">
        </fieldset>

    </div>

    <div class="row">
        <fieldset class="form-group col-4">
          <label for="for_name">Nombre</label>
          <input type="text" class="form-control" id="for_name" placeholder="" name="name" required="">
        </fieldset>

        <fieldset class="form-group col-4">
          <label for="for_fathers_family">Apellido Paterno</label>
          <input type="text" class="form-control" id="for_fathers_family" placeholder="" name="fathers_family" required="">
        </fieldset>

        <fieldset class="form-group col-4">
            <label for="for_mothers_family">Apellido Materno</label>
            <input type="text" class="form-control" id="for_mothers_family" placeholder="" name="mothers_family" required="">
        </fieldset>
    </div>

    <div class="row">
      <fieldset class="form-group col">
          <label for="for_job_title">Función</label>
          <input type="text" class="form-control" id="for_job_title" placeholder="" name="job_title">
      </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Crear</button>

</form>

@endsection

@section('custom_js')
  <script>
    $( document ).ready(function() {
      document.getElementById("for_rut").focus();
    });
  </script>
@endsection
