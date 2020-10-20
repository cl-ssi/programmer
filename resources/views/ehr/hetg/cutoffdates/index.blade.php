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
                    <a href="{{ route('ehr.hetg.management.report.reportcut', $cutoffdate) }}" class="btn btn-sm btn-outline-info">
                    Exportar a Excel
                    <i class="far fa-file-excel"></i></a>
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
                  <th>Rdto/Hr</th>
                  <th>Rdto/Diario</th>
                  <th>Rdto/Semanal</th>
                  <th>Rdto/Mensual</th>
                  <th>Rdto/Anual</th>
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

                                      @if($value4['rdto_hour'] != null)

                                          <td><label id="horas_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}" value="{{$value4['assigned_hour']}}">{{$value4['assigned_hour']}}</label></td>
                                          <td><input type="text" id="rdto_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}" value="{{$value4['rdto_hour']}}" /></td>
                                          <td><label id="diario_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}">{{$value4['assigned_hour'] * $value4['rdto_hour']}}</label></td>
                                          <td><label id="semanal_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}">{{($value4['assigned_hour'] * $value4['rdto_hour']) * 7}}</label></td>
                                          <td><label id="mensual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}">{{($value4['assigned_hour'] * $value4['rdto_hour']) * 7 * 4}}</label></td>
                                          <td><label id="anual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}">{{($value4['assigned_hour'] * $value4['rdto_hour']) * 7 * 4 * 52}}</label></td>

                                          @foreach ($value4['theoricalProgramming_id'] as $key5 => $value5)
                                              <input type="hidden" id="id_{{$value5['id']}}" value="{{$value5['id']}}" />
                                          @endforeach

                                      @else
                                          <td><label>{{$value4['assigned_hour']}}</label></td>
                                          <td>--</td>
                                          <td>--</td>
                                          <td>--</td>
                                          <td>--</td>
                                          <td>--</td>
                                      @endif

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
                    <th>Rdto/Hr</th>
                    <th>Rdto/Diario</th>
                    <th>Rdto/Semanal</th>
                    <th>Rdto/Mensual</th>
                    <th>Rdto/Anual</th>
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

                                      {{-- @if($value4['rdto_hour'] != null)
                                          <td><input type="text" id="rdto" value="{{$value4['rdto_hour']}}" /></td>
                                          <td>{{$value4['assigned_hour'] * $value4['rdto_hour']}}</td>
                                          <td>{{($value4['assigned_hour'] * $value4['rdto_hour']) * 7}}</td>
                                          <td>{{($value4['assigned_hour'] * $value4['rdto_hour']) * 7 * 4}}</td>
                                          <td>{{($value4['assigned_hour'] * $value4['rdto_hour']) * 7 * 4 * 52}}</td>
                                      @else
                                          <td>--</td>
                                          <td>--</td>
                                          <td>--</td>
                                          <td>--</td>
                                          <td>--</td>
                                      @endif --}}

                                      @if($value4['rdto_hour'] != null)
                                          {{-- <input type="hidden" id="id_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}" value="{{$value4['theoricalProgramming_id']}}" /> --}}
                                          <td><label id="horas_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}" value="{{$value4['assigned_hour']}}">{{$value4['assigned_hour']}}</label></td>
                                          <td><input type="text" id="rdto_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}" value="{{$value4['rdto_hour']}}" /></td>
                                          <td><label id="diario_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}">{{$value4['assigned_hour'] * $value4['rdto_hour']}}</label></td>
                                          <td><label id="semanal_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}">{{($value4['assigned_hour'] * $value4['rdto_hour']) * 7}}</label></td>
                                          <td><label id="mensual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}">{{($value4['assigned_hour'] * $value4['rdto_hour']) * 7 * 4}}</label></td>
                                          <td><label id="anual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}">{{($value4['assigned_hour'] * $value4['rdto_hour']) * 7 * 4 * 52}}</label></td>

                                          @foreach ($value4['theoricalProgramming_id'] as $key5 => $value5)
                                              <input type="hidden" id="id_{{$value5['id']}}" value="{{$value5['id']}}" />
                                          @endforeach

                                      @else
                                          <td><label>{{$value4['assigned_hour']}}</label></td>
                                          <td>--</td>
                                          <td>--</td>
                                          <td>--</td>
                                          <td>--</td>
                                          <td>--</td>
                                      @endif

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

    <script>
    $( document ).ready(function() {

        @if($array_programacion_medica != null)
        @foreach ($array_programacion_medica as $key1 => $value1)
            @foreach ($value1 as $key2 => $value2)
                @foreach ($value2 as $key3 => $value3)
                    @foreach ($value3 as $key4 => $value4)
                        @if($value4['rdto_hour'] != null)
                        // cuando se deja focus
                            $("#rdto_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}").change(function() {
                                // var id = $('#id_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').val();
                                var horas = $('#horas_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text();
                                var rdto = $('#rdto_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').val();

                                $('#diario_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto);
                                $('#semanal_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7);
                                $('#mensual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7 * 4);
                                $('#anual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7 * 4 * 52);

                                @foreach ($value4['theoricalProgramming_id'] as $key5 => $value5)
                                    var id = $('#id_{{$value5['id']}}').val();
                                    savePerformance(id, rdto);
                                @endforeach

                            });
                        // al presionar enter
                        $('#rdto_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').keyup(function(e){
                            if(e.keyCode == 13 || e.keyCode == 9)
                            {
                                // var id = $('#id_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').val();
                                var horas = $('#horas_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text();
                                var rdto = $('#rdto_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').val();

                                $('#diario_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto);
                                $('#semanal_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7);
                                $('#mensual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7 * 4);
                                $('#anual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7 * 4 * 52);

                                @foreach ($value4['theoricalProgramming_id'] as $key5 => $value5)
                                    var id = $('#id_{{$value5['id']}}').val();
                                    savePerformance(id, rdto);
                                @endforeach
                            }
                        });
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        @endif

        @if($array_programacion_no_medica != null)
        @foreach ($array_programacion_no_medica as $key1 => $value1)
            @foreach ($value1 as $key2 => $value2)
                @foreach ($value2 as $key3 => $value3)
                    @foreach ($value3 as $key4 => $value4)
                        @if($value4['rdto_hour'] != null)
                        // cuando se deja focus
                            $("#rdto_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}").change(function() {
                                // var id = $('#id_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').val();
                                var horas = $('#horas_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text();
                                var rdto = $('#rdto_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').val();

                                $('#diario_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto);
                                $('#semanal_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7);
                                $('#mensual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7 * 4);
                                $('#anual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7 * 4 * 52);

                                @foreach ($value4['theoricalProgramming_id'] as $key5 => $value5)
                                    var id = $('#id_{{$value5['id']}}').val();
                                    savePerformance(id, rdto);
                                @endforeach
                            });
                        // al presionar enter
                        $('#rdto_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').keyup(function(e){
                            if(e.keyCode == 13 || e.keyCode == 9)
                            {
                                // var id = $('#id_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').val();
                                var horas = $('#horas_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text();
                                var rdto = $('#rdto_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').val();

                                $('#diario_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto);
                                $('#semanal_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7);
                                $('#mensual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7 * 4);
                                $('#anual_{{$value4['theoricalProgramming_id'][array_key_first($value4['theoricalProgramming_id'])]['id']}}').text(horas * rdto * 7 * 4 * 52);

                                @foreach ($value4['theoricalProgramming_id'] as $key5 => $value5)
                                    var id = $('#id_{{$value5['id']}}').val();
                                    savePerformance(id, rdto);
                                @endforeach
                            }
                        });
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        @endif


        function savePerformance(id, performance_value) {
          $.ajax({
              url: "{{ route('ehr.hetg.cutoffdates.savePerformance') }}",
              type: 'post',
              data:{id:id,performance_value:performance_value},
              headers: {
                  'X-CSRF-TOKEN': "{{ csrf_token() }}"
              },
          });
        }
    });


    </script>



@endsection
