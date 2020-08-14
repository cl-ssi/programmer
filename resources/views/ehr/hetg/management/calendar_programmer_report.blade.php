@extends('layouts.app')

@section('title', 'Reporte de programación')

@section('content')

<h3 class="mb-3">Reporte de programación</h3>

{{-- <table class="table table-sm table-borderer"> --}}
<table class="table table-sm table-bordered table-responsive small text-uppercase" id="tabla_casos">
    <thead>
        <tr>
            <th colspan="3"></th>
            <th class="text-center" colspan="5">Hrs.Sem.Contr.</th>
            <th class="text-center" colspan="52">Hrs. Semanales Programadas</th>
        </tr>
        <tr>
            <th>Especialidad</th>
            <th>Rut</th>
            <th>Profesional</th>
            <th nowrap>Totales</th>
            <th nowrap>Cons.Médica</th>
            <th nowrap>Pabellón</th>
            <th nowrap>Ejecutado</th>
            <th nowrap>Diferencia</th>
            @for ($i = 1; $i <=52; $i++)
                <th>{{$i}}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach( $array as $key => $data)
          @foreach($data as $key2 => $data_array)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $key2 }}</td>
                <td nowrap>{{ $data_array['rrhh']->getShortNameAttribute() }}</td>
                <td nowrap>{{ $data_array['rrhh']->assigned_hour }}</td>
                <td nowrap>{{ $data_array['rrhh']->assigned_hour_activities_cons_medica }}</td>
                <td nowrap>{{ $data_array['rrhh']->assigned_hour_activities_pabellon }}</td>
                <td></td>
                <td></td>
                @for ($i = 1; $i <=52; $i++)
                  <th>
                  @foreach ($data_array['array'] as $key3 => $calendarProgramming)
                     @foreach($calendarProgramming as $week => $data)
                       @if($week == $i)
                         {{$data}}
                       @endif
                    @endforeach
                  @endforeach
                  </th>
                @endfor

                  {{-- @foreach ($data_array['array'] as $key3 => $calendarProgramming)
                     @foreach($calendarProgramming as $week => $data)
                       @for ($i = 1; $i <=52; $i++)
                         @if($week == $i)
                           <td>{{$data}}</td>
                         @else
                           <th></th>
                         @endif
                       @endfor

                    @endforeach
                  @endforeach --}}


            </tr>
            {{-- @foreach($data_array['rrhh'] as $rrhh)
              <tr>
                  <td>{{ $key }}</td>
                  <td>{{ $rrhh }}</td>
              </tr>
            @endforeach --}}
          @endforeach
        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection
