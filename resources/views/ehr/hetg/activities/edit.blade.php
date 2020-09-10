@extends('layouts.app')

@section('title', 'Editar Actividad')

@section('content')

<h3 class="mb-3">Editar Actividad</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.activities.update', $activity) }}">
    @csrf
    @method('PUT')

    <div class="row">
        <fieldset class="form-group col-2">
            <label for="for_id_actividad">id_actividad</label>
            <input type="text" class="form-control" id="for_id_actividad" placeholder="" name="id_activity" required value="{{$activity->id_activity}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_activity_name">Actividad Madre</label>
            <select name="mother_activity_id" id="law" class="form-control">
              <option value="">--</option>
              @foreach ($motherActivities as $key => $motherActivity)
                <option value="{{$motherActivity->id}}" {{ $activity->mother_activity_id == $motherActivity->id ? 'selected' : '' }}>{{$motherActivity->description}}</option>
              @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_activity_type_id">Tipo de actividad</label>
            <select name="activity_type_id" id="for_activity_type_id" class="form-control activity">
              <option value="">--</option>
              @foreach ($activityTypes as $key => $activityType)
                <option value="{{$activityType->id}}" {{ $activity->activity_type_id == $activityType->id ? 'selected' : '' }}>{{$activityType->name}}</option>
              @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_activity_name">Actividad</label>
            <input type="text" class="form-control" id="for_activity_name" placeholder="" name="activity_name" required value="{{$activity->activity_name}}">
        </fieldset>
    </div>

    {{-- <div id="dvPinNo" style="display: none">
      <hr>
      <fieldset class="form-group col-12 col-md-6">
        <label for="">Profesiones (Escribir rendimiento si se selecciona)</label>
        <table>
          @foreach($professions as $profession)
              @foreach($activity->professions as $profession2)
                  <tr>
                    <td>
                        <input class="form-check" type="checkbox" {{ $profession->id == $profession2->id ? 'checked' : '' }} name="profession_id[]" value="{{ $profession->id }}">
                    </td>
                    <td>
                      <label class="form-check-label">
                        {{ $profession->profession_name }}
                      </label>
                    </td>
                    <td>
                      <input type="text" name="performance_profession_{{$profession->id}}" class="form-control col-md-4" id="for_activity_name" placeholder="ej: 3">
                    </td>
                  </tr>
            @endforeach
          @endforeach
        </table>
      </fieldset>
      <hr>
    </div>

    <div id="dvPinSi" style="display: none">
    <hr>
      <fieldset class="form-group col-12 col-md-6">
        <label for="">Especialidades (Escribir rendimiento si se selecciona Especialidad)</label>
        <table>

          @foreach($specialties as $specialty)
              @foreach($activity->specialties as $specialty2)
                  <tr>
                    <td>
                        <input class="form-check" type="checkbox" {{ $specialty->id == $specialty2->id ? 'checked' : '' }} name="specialty_id[]" value="{{ $specialty->id }}">
                    </td>
                    <td>
                      <label class="form-check-label">
                        {{ $specialty->specialty_name }}
                      </label>
                    </td>
                    <td>
                        @if($specialty->id == $specialty2->id)
                            <input type="text" name="performance_specialty_{{$specialty->id}}" value="{{$specialty2->pivot->performance}}" class="form-control col-md-6" id="for_activity_name" placeholder="ej: 4">
                        @else
                            <input type="text" name="performance_specialty_{{$specialty->id}}" class="form-control col-md-6" id="for_activity_name" placeholder="ej: 4">
                        @endif
                    </td>
                  </tr>
            @endforeach
          @endforeach
        </table>
      </fieldset>
      <hr>
    </div> --}}

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

    <script type="text/javascript">
      $(document).ready(function() {

        $("select.activity").change(function() {
          var selectedcategory = $(this).children("option:selected").val();
          if (selectedcategory == '2') {
            $("#dvPinSi").hide();
            $("#dvPinNo").show();
          } else if (selectedcategory == '1') {

            $("#dvPinSi").show();
            $("#dvPinNo").hide();
          } else {
            $("#dvPinNo").hide();
            $("#dvPinSi").hide();
          }
        });

        //ejecuta select
        $("#for_activity_type_id").val({{$activity->activity_type_id}}).change();

      });
    </script> --}}

@endsection
