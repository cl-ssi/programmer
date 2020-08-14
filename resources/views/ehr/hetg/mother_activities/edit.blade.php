@extends('layouts.app')

@section('title', 'Editar Actividad Madre')

@section('content')

<h3 class="mb-3">Editar Actividad Madre</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.mother_activities.update', $motherActivity) }}">
    @csrf
    @method('PUT')

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_description">Actividad Madre</label>
            <input type="text" class="form-control" id="for_description" placeholder="" name="description" required value="{{$motherActivity->description}}">
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@endsection

@section('custom_js')

@endsection
