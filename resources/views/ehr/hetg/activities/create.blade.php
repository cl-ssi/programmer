@extends('layouts.app')

@section('title', 'Nueva Actividad')

@section('content')

<h3 class="mb-3">Nueva Actividad</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.activities.store') }}">
    @csrf
    @method('POST')

    <div class="row">
        <fieldset class="form-group col-2">
            <label for="for_id">Id</label>
            <input type="text" class="form-control" id="for_id" placeholder="" name="id" required>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_activity_name">Actividad Madre</label>
            <select name="mother_activity_id" id="law" class="form-control">
              <option value="">--</option>
              @foreach ($motherActivities as $key => $motherActivity)
                <option value="{{$motherActivity->id}}">{{$motherActivity->description}}</option>
              @endforeach
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_activity_name">Actividad</label>
            <input type="text" class="form-control" id="for_activity_name" placeholder="" name="activity_name" required>
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

@endsection
