@extends('layouts.app')

@section('title', 'Editar Fecha de corte')

@section('content')

<h3 class="mb-3">Editar Fecha de corte</h3>

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.cutoffdates.update', $cutoffdate) }}">
    @csrf
    @method('PUT')

    <div class="row">

        <fieldset class="form-group col">
            <label for="for_description">Fecha</label>
            <input name="date" class="form-control" type="date" value="{{ Carbon\Carbon::parse($cutoffdate->date)->format('Y-m-d') }}">
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_observation">Observación</label>
            <input type="text" class="form-control" id="for_observation" placeholder="" name="observation" required value="{{$cutoffdate->observation}}">
        </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

@canany(['administrador'])
    <br /><hr />
    <div style="height: 300px; overflow-y: scroll;">
        @include('partials.audit', ['audits' => $cutoffdate->audits] )
    </div>
@endcanany

@endsection

@section('custom_js')

@endsection
