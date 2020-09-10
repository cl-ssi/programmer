@extends('layouts.app')

@section('title', 'Nueva Especialidad')

@section('content')

<script src="{{ asset('js/colorpicker/jscolor.js') }}"></script>

<h3 class="mb-3">Nueva Especialidad</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.specialties.store') }}">
    @csrf
    @method('POST')

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_id_specialty">id_specialty</label>
            <input type="text" class="form-control" id="for_id_specialty" name="id_specialty" required>
        </fieldset>

        {{-- <fieldset class="form-group col">
            <label for="for_id_sigte">id Sigte</label>
            <input type="text" class="form-control" id="for_id_sigte" placeholder="(opcional)" name="id_sigte">
        </fieldset> --}}
    </div>

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_specialty_name">Especialidad</label>
            <input type="text" class="form-control" id="for_specialty_name" placeholder="" name="specialty_name" required>
        </fieldset>

        <fieldset class="form-group col-4">
            <label for="for_name">Color</label>
            <input class="form-control jscolor" name="color" value="ab2567" required="">
        </fieldset>
    </div>

    <hr>
    <fieldset class="form-group col-12 col-md-6">
      <label for="">Actividades (Escribir rendimiento si se selecciona)</label>
      <table>
        @foreach($activities as $activity)
        <tr>
          <td>
              <input class="form-check" type="checkbox" name="activity_id[]" value="{{ $activity->id }}">
          </td>
          <td>
            <label class="form-check-label">
              {{ $activity->activity_name }}
            </label>
          </td>
          <td>
            <input type="text" name="performance_activity_{{$activity->id}}" class="form-control col-md-4" id="for_activity_name" placeholder="ej: 3">
          </td>
        </tr>
        @endforeach
      </table>
    </fieldset>
    <hr>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

@endsection
