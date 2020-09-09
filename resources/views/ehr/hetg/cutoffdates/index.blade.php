@extends('layouts.app')

@section('title', 'Listado de Fechas de corte')

@section('content')

<h3 class="mb-3">Listado de Fechas de corte</h3>

<a class="btn btn-primary mb-3" href="{{ route('ehr.hetg.cutoffdates.create') }}">
    <i class="fas fa-plus"></i> Agregar nueva
</a>

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Observación</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $cutoffdates as $cutoffdate )
        <tr>
            <td>{{ $cutoffdate->id }}</td>
            <td>{{ Carbon\Carbon::parse($cutoffdate->date)->format('Y-m-d') }}</td>
            <td>{{ $cutoffdate->observation }}</td>
            <td>
      				<a href="{{ route('ehr.hetg.cutoffdates.edit', $cutoffdate) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('ehr.hetg.cutoffdates.destroy', $cutoffdate) }}" class="d-inline">
      					@csrf
      					@method('DELETE')
      					<button type="submit" class="btn btn-outline-secondary btn-sm" onclick="return confirm('¿Está seguro de eliminar la información?');">
      						<span class="fas fa-trash-alt" aria-hidden="true"></span>
      					</button>
      				</form>

                    <a href="{{ route('ehr.hetg.cutoffdates.consolidated_programming', $cutoffdate) }}"
                       class="btn btn-sm btn-outline-info">
                        Consolidado Programación
                    </a>
      			</td>
        </tr>
        @endforeach
    </tbody>
</table>


@if($array_programacion_medica != null)
<hr />

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Programación Médica</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Programación no médica</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

      <div class="row">
        <div class="col">

          <div class="table-responsive-sm">
            <table class="table table-sm table-bordered text-center table-striped small">
              <thead>
                <tr class="text-center">
                  <th>Rut</th>
                  <th>Contrato</th>
                  <th>Especialidad</th>
                  <th>Actividad</th>
                  <th>Hrs. Asignadas</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($array_programacion_medica as $key1 => $value1)
                      @foreach ($value1 as $key2 => $value2)
                          @foreach ($value2 as $key3 => $value3)
                              @foreach ($value3 as $key4 => $value4)
                                  <tr>
                                      <td>{{$key1}}</td>
                                      <td>{{$key2}}</td>
                                      <td>{{$key3}}</td>
                                      <td>{{$key4}}</td>
                                      <td>{{$value4}}</td>
                                  </tr>
                              @endforeach
                          @endforeach
                      @endforeach
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

  </div>

  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

      <div class="row">
        <div class="col">

          <div class="table-responsive-sm">
            <table class="table table-sm table-bordered text-center table-striped small">
              <thead>
                <tr class="text-center">
                  <th>Rut</th>
                  <th>Contrato</th>
                  <th>Especialidad</th>
                  <th>Actividad</th>
                  <th>Hrs. Asignadas</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($array_programacion_no_medica as $key1 => $value1)
                      @foreach ($value1 as $key2 => $value2)
                          @foreach ($value2 as $key3 => $value3)
                              @foreach ($value3 as $key4 => $value4)
                                  <tr>
                                      <td>{{$key1}}</td>
                                      <td>{{$key2}}</td>
                                      <td>{{$key3}}</td>
                                      <td>{{$key4}}</td>
                                      <td>{{$value4}}</td>
                                  </tr>
                              @endforeach
                          @endforeach
                      @endforeach
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

  </div>
</div>

@endif


@endsection

@section('custom_js')

@endsection
