@extends('layouts.app')

@section('title', 'Nueva Actividad')

@section('content')

<h3 class="mb-3">Nueva Actividad</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.mother_activities.store') }}">
    @csrf
    @method('POST')

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_description">Actividad Madre</label>
            <input type="text" class="form-control" id="for_description" placeholder="" name="description" required>
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

@endsection
