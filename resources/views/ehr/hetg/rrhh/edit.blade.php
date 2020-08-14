@extends('layouts.app')

@section('title', 'Editar RRHH')

@section('content')



<h3 class="mb-3">Editar RRHH</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.rrhh.update', $rrhh) }}">
  @csrf
  @method('PUT')

    <div class="row">
        <fieldset class="form-group col-3">
            <label for="for_barcode">Rut</label>
            <input type="text" class="form-control" id="for_rut" placeholder="Rut" name="rut" required="" value="{{$rrhh->rut}}">
        </fieldset>

        <fieldset class="form-group col-1">
            <label for="for_dv">Dv</label>
            <input type="text" class="form-control" id="for_dv" placeholder="Dv" name="dv" required="" value="{{$rrhh->dv}}">
        </fieldset>

    </div>

    <div class="row">
        <fieldset class="form-group col-4">
          <label for="for_name">Nombre</label>
          <input type="text" class="form-control" id="for_name" placeholder="" name="name" required="" value="{{$rrhh->name}}">
        </fieldset>

        <fieldset class="form-group col-4">
          <label for="for_fathers_family">Apellido Paterno</label>
          <input type="text" class="form-control" id="for_fathers_family" placeholder="" name="fathers_family" required="" value="{{$rrhh->fathers_family}}">
        </fieldset>

        <fieldset class="form-group col-4">
            <label for="for_mothers_family">Apellido Materno</label>
            <input type="text" class="form-control" id="for_mothers_family" placeholder="" name="mothers_family" required="" value="{{$rrhh->mothers_family}}">
        </fieldset>
    </div>

    <div class="row">
      <fieldset class="form-group col">
          <label for="for_job_title">Función</label>
          <input type="text" class="form-control" id="for_job_title" placeholder="" name="job_title" value="{{$rrhh->job_title}}">
      </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')
  <script>
    $( document ).ready(function() {
      document.getElementById("for_rut").focus();
    });
  </script>
@endsection
