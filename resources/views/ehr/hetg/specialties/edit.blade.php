@extends('layouts.app')

@section('title', 'Editar Especialidad')

@section('content')

<script src="{{ asset('js/colorpicker/jscolor.js') }}"></script>

<h3 class="mb-3">Editar Especialidad</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.specialties.update', $specialty) }}">
    @csrf
    @method('PUT')

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_id_specialty">id_specialty</label>
            <input type="text" class="form-control" id="for_id_specialty" name="id_specialty" required value="{{$specialty->id_specialty}}">
        </fieldset>

        {{-- <fieldset class="form-group col">
            <label for="for_id_sigte">id Sigte</label>
            <input type="text" class="form-control" id="for_id_sigte" placeholder="(opcional)" name="id_sigte" value="{{$specialty->id_sigte}}">
        </fieldset> --}}
    </div>

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_specialty_name">Especialidad</label>
            <input type="text" class="form-control" id="for_specialty_name" placeholder="" name="specialty_name" required value="{{$specialty->specialty_name}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_name">Color</label>
            <input class="form-control jscolor" id="color" name="color" required="" value="{{$specialty->color}}" onchange="update(this.jscolor)">
        </fieldset>
    </div>

    <hr>
      <fieldset class="form-group col-12 col-md-6">
        <h3><label for="">Actividades Médicas</label></h3>
        <table>

            {{-- {{$specialty->activities}} --}}
          @foreach($activities as $activity)

                  <tr>
                    <td>
                        @if($specialty->activities->where('id',$activity->id)->count() > 0)
                            <input class="form-check" type="checkbox" checked name="activity_id[]" value="{{ $activity->id }}">
                        @else
                            <input class="form-check" type="checkbox" name="activity_id[]" value="{{ $activity->id }}">
                        @endif
                    </td>
                    <td>
                      <label class="form-check-label">
                        {{ $activity->activity_name }}
                      </label>
                    </td>
                    @if($activity->performance == 1)
                        <td>
                          @if($specialty->activities->where('id',$activity->id)->count() > 0)
                              <input type="text" name="performance_activity_{{$activity->id}}" value="{{$specialty->activities->where('id',$activity->id)->first()->pivot->performance}}" class="form-control col-md-6" id="for_activity_name" placeholder="ej: 4">
                          @else
                              <input type="text" name="performance_activity_{{$activity->id}}" class="form-control col-md-6" id="for_activity_name" placeholder="ej: 4">
                          @endif
                        </td>
                    @else
                        <td><input type="text" class="form-control col-md-6" placeholder="--" disabled></td>
                    @endif
                  </tr>

          @endforeach
        </table>
      </fieldset>
    <hr>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@include('partials.audit', ['audits' => $specialty->audits])

@foreach ($specialty->activities as $key => $activity)
    @include('partials.audit_loop', ['audits' => $activity->audits])
@endforeach

@endsection

@section('custom_js')
  <script>
    $( document ).ready(function() {
      document.getElementById("for_id_specialty").focus();
    });

    function update(jscolor) {
        // 'jscolor' instance can be used as a string
        document.getElementById('rect').style.backgroundColor = '#' + jscolor
    }
  </script>
@endsection
