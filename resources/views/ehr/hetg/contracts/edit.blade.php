@extends('layouts.app')

@section('title', 'Editar Contrato')

@section('content')

<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>

<h3 class="mb-3">Editar Contrato</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.contracts.update', $contract) }}">
  @csrf
  @method('PUT')

    <div class="row">
        <fieldset class="form-group col-4">
            <label for="for_rut">Rut</label>
            <input type="text" class="form-control" id="for_rut" disabled value="{{$contract->rut}}">
        </fieldset>

        <input type="hidden" class="form-control" id="for_rut2" name="rut" value="{{$contract->rut}}">

        <fieldset class="form-group col-8">
            <label for="for_rrhh">Especialista</label>
            <select name="rrhh" id="rrhh" class="form-control selectpicker" required="" data-live-search="true" data-size="5">
              <option>--</option>
              @foreach($rrhh as $trab)
                <option value="{{$trab->rut}}" {{ $trab->rut == $contract->rut ? 'selected' : '' }}>{{$trab->getFullNameAttribute()}}</option>
              @endforeach
            </select>
        </fieldset>
    </div>

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_law">Ley</label>
            <select name="law" id="law" class="form-control" required="">
              <option value="LEY 18.834" {{ $contract->law == "LEY 18.834" ? 'selected' : '' }}>LEY 18.834</option>
              <option value="LEY 19.664" {{ $contract->law == "LEY 19.664" ? 'selected' : '' }}>LEY 19.664</option>
              <option value="LEY 15.076" {{ $contract->law == "LEY 15.076" ? 'selected' : '' }}>LEY 15.076</option>
              <option value="HSA" {{ $contract->law == "HSA" ? 'selected' : '' }}>HSA</option>
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_contract_id">Correlativo Contrato</label>
            <input type="text" class="form-control" id="for_contract_id" placeholder="(opcional)" name="contract_id" value="{{$contract->contract_id}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_weekly_hours">Hrs.Semanales contratadas</label>
            <input type="text" class="form-control" id="for_weekly_hours" placeholder="" name="weekly_hours" required value="{{$contract->weekly_hours}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_shift_system">Sistema de turno</label>
            <select name="shift_system" id="for_shift_system" class="form-control">
              <option value="" {{ $contract->shift_system == "" ? 'selected' : '' }}>--</option>
              <option value="S" {{ $contract->shift_system == "S" ? 'selected' : '' }}>Sí</option>
              <option value="N" {{ $contract->shift_system == "N" ? 'selected' : '' }}>No</option>
            </select>
        </fieldset>
    </div>

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_obs">Observaciones (liberado de guardia)</label>
            <input type="text" class="form-control" id="for_obs" name="obs" value="{{$contract->obs}}">
        </fieldset>
    </div>

    <div class="row">
        <fieldset class="form-group col">
            <br /><label for="for_legal_holidays">Feriados legales</label>
            <input type="text" class="form-control" id="for_legal_holidays" name="legal_holidays" value="{{$contract->legal_holidays}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_compensatory_rest">Días descanso compensatorio</label>
            <input type="text" class="form-control" id="for_compensatory_rest" name="compensatory_rest" value="{{$contract->compensatory_rest}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_administrative_permit">Días permisos administrativos</label>
            <input type="text" class="form-control" id="for_administrative_permit" name="administrative_permit" value="{{$contract->administrative_permit}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_training_days">Días congreso o capacitación</label>
            <input type="text" class="form-control" id="for_training_days" name="training_days" value="{{$contract->training_days}}">
        </fieldset>

        <fieldset class="form-group col">
            <br /><label for="for_breastfeeding_time">Tiempo lactancia (min)</label>
            <input type="text" class="form-control" id="for_breastfeeding_time" name="breastfeeding_time" value="{{$contract->breastfeeding_time}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_weekly_collation">Tiempo colación semanal (min)</label>
            <input type="text" class="form-control" id="for_weekly_collation" name="weekly_collation" value="{{$contract->weekly_collation}}">
        </fieldset>
    </div>


    <div class="row">
        <fieldset class="form-group col">
            <label for="for_contract_start_date">Fecha inicio contrato</label>
            <input type="date" class="form-control" id="for_contract_start_date" name="contract_start_date" required  value="{{$contract->contract_start_date}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_contract_end_date">Fecha término contrato</label>
            <input type="date" class="form-control" id="for_contract_end_date" name="contract_end_date" required  value="{{$contract->contract_end_date}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_unit">Servicio / Unidad</label>
            <input type="text" class="form-control" id="for_unit" name="unit" value="{{$contract->unit}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_unit_code">Cod. Unidad</label>
            <input type="text" class="form-control" id="for_unit_code" name="unit_code" value="{{$contract->unit_code}}">
        </fieldset>
    </div>

    <div class="row">
      <fieldset class="form-group col">
          <label for="for_unit_code">Año de contrato válido</label>
          <select name="year" id="for_year" class="form-control" required="">
            <option value="2020" {{ $contract->year == "2020" ? 'selected' : '' }}>2020</option>
            <option value="2021" {{ $contract->year == "2021" ? 'selected' : '' }}>2021</option>
            <option value="2022" {{ $contract->year == "2022" ? 'selected' : '' }}>2022</option>
            <option value="2023" {{ $contract->year == "2023" ? 'selected' : '' }}>2023</option>
            <option value="2024" {{ $contract->year == "2024" ? 'selected' : '' }}>2024</option>
            <option value="2025" {{ $contract->year == "2025" ? 'selected' : '' }}>2025</option>
          </select>
      </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@include('partials.audit', ['audits' => $contract->audits] )

@endsection

@section('custom_js')
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

<script>
$( "#rrhh" ).change(function() {
  $( "#for_rut" ).val($( "#rrhh" ).val());
  $( "#for_rut2" ).val($( "#rrhh" ).val());
});
</script>
@endsection
