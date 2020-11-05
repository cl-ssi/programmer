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

    </div>

    <div class="row">

        <fieldset class="form-group col">
            <label for="for_activity_name">Actividad</label>
            <input type="text" class="form-control" id="for_activity_name" placeholder="" name="activity_name" required value="{{$activity->activity_name}}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_description">Descripción</label>
            <input type="text" class="form-control" id="for_description" placeholder="" name="description" required value="{{$activity->description}}">
        </fieldset>

        <fieldset class="form-group col">
          <label for="for_performance">Rendimiento</label>
          <select name="performance" id="for_performance" class="form-control activity">
            <option value="1" {{ $activity->performance == 1 ? 'selected' : '' }}>R</option>
            <option value="0" {{ $activity->performance == 0 ? 'selected' : '' }}>NR</option>
          </select>
        </fieldset>

    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@canany(['administrador'])
    <br /><hr />
    <div style="height: 300px; overflow-y: scroll;">
        @include('partials.audit', ['audits' => $activity->audits] )
    </div>
@endcanany

@endsection

@section('custom_js')

@endsection
