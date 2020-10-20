@extends('layouts.app')

@section('title', 'Editar Programación Médica')

@section('content')

<h3 class="mb-3">Editar Programación Médica</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.unscheduled_programming.update', $unscheduledProgramming) }}">
    @csrf
    @method('PUT')

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_rut">Especialista</label>
            <select name="rut" id="rut" class="form-control" required="">
              <option>--</option>
              @foreach($rrhh as $trab)
                <option value="{{$trab->rut}}" {{ $trab->rut == $unscheduledProgramming->rut ? 'selected' : '' }}>{{$trab->getFullNameAttribute()}}</option>
              @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_contract_id">Contrato</label>
            <select name="contract_id" id="for_contract_id" class="form-control" required="">
            </select>
        </fieldset>
    </div>

    <div class="row">
      <fieldset class="form-group col">
          <label for="for_specialty_id">Especialidad</label>
          <select name="specialty_id" id="for_specialty_id" class="form-control" required="">
            @foreach($specialties as $specialty)
              <option value="{{$specialty->id}}" {{ $specialty->id == $unscheduledProgramming->specialty_id ? 'selected' : '' }}>{{$specialty->specialty_name}}</option>
            @endforeach
          </select>
      </fieldset>

      <fieldset class="form-group col">
          <label for="for_activity_id">Actividad</label>
          <select name="activity_id" id="for_activity_id" class="form-control" required="">
            @foreach($activities as $activity)
              <option value="{{$activity->id}}" {{ $activity->id == $unscheduledProgramming->activity_id ? 'selected' : '' }}>{{$activity->id}} - {{$activity->activity_name}}</option>
            @endforeach
          </select>
      </fieldset>
    </div>

    <div class="row">
      <fieldset class="form-group col">
          <label for="for_assigned_hour">Horas Asignadas</label>
          <input type="text" class="form-control" id="for_assigned_hour" placeholder="" name="assigned_hour" required value="{{$unscheduledProgramming->assigned_hour}}">
      </fieldset>

      <fieldset class="form-group col">
          <label for="for_hour_performance">Rdto. por Hora</label>
          <input type="text" class="form-control" id="for_hour_performance" placeholder="" name="hour_performance" value="{{$unscheduledProgramming->hour_performance}}">
      </fieldset>
    </div>

    <div class="row">
      <fieldset class="form-group col">
          <label for="for_unit_code">Año</label>
          <select name="year" id="for_year" class="form-control" required="">
            <option value="2020" {{ $unscheduledProgramming->year == "2020" ? 'selected' : '' }}>2020</option>
            <option value="2021" {{ $unscheduledProgramming->year == "2021" ? 'selected' : '' }}>2021</option>
            <option value="2022" {{ $unscheduledProgramming->year == "2022" ? 'selected' : '' }}>2022</option>
            <option value="2023" {{ $unscheduledProgramming->year == "2023" ? 'selected' : '' }}>2023</option>
            <option value="2024" {{ $unscheduledProgramming->year == "2024" ? 'selected' : '' }}>2024</option>
            <option value="2025" {{ $unscheduledProgramming->year == "2025" ? 'selected' : '' }}>2025</option>
          </select>
      </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')
  <script>
  $(document).ready(function() {
      $( "#rut" ).change();
  });

  $( "#rut" ).change(function() {
    // elimina lo que esté
    $('#for_contract_id').find('option').remove();

    // deja options que coincidan
    @foreach($contracts as $contract)
      if($("#rut").val() == {{$contract->rut}}){
        $('#for_contract_id').append(`<option value="{{$contract->id}}" {{ $contract->id == $unscheduledProgramming->contract_id ? 'selected' : '' }}>{{$contract->law}} - {{$contract->contract_id}} - {{$contract->weekly_hours}} hrs.</option>`);
      }
    @endforeach
  });
  </script>
@endsection
