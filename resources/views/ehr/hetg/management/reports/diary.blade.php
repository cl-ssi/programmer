@extends('layouts.app')

@section('title', 'Pabellon Producción Semanal')

@section('content')

<h3 class="mb-3">Reporte de producción diario</h3>

<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{ route('ehr.hetg.management.report.diary') }}">
			@csrf
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="inlineFormInput">Fecha</label>
                    <input type="date" class="form-control" name="day" value="{{ $now }}">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                </div>
            </div>
        </form>


	</div>
</div>

<table class="table table-sm table-bordered small">
  <thead>
    <tr>
      <th scope="col">Especialidad</th>
      <th scope="col">Hrs.Procedimientos</th>
			<th scope="col">Porc.</th>
			<th scope="col">Prom.Hrs.Procedimiento</th>
      <th scope="col">Cant.Procedimientos</th>
    </tr>
  </thead>
  <tbody>
    @foreach($specialties as $key => $specialty)
    <tr>
      <td>
        <span class='badge badge-primary' style='background-color: #{{$specialty->color}};'><font color="black">{{$specialty->medico_especialidad_desc}}</font></span>
      </td>
      <td>{{$specialty->total_horas}}</td>
			<td>{{$specialty->prom}}%</td>
			<td>{{$specialty->promedio_duracion_intervencion}} hrs.</td>
      <td>{{$specialty->totalProcedimientos}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div id='calendar'></div>

@endsection

@section('custom_js')

@endsection

@section('custom_js_head')

<link href='{{asset('assets/fullcalendar/packages/core/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/daygrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/timegrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/list/main.css')}}' rel='stylesheet' />
<!-- <link href='{{asset('assets/fullcalendar/css/style.css')}}' rel='stylesheet' /> -->

<script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages/interaction/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages/timegrid/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages-premium/resource-common/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages-premium/resource-daygrid/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages-premium/resource-timegrid/main.js')}}'></script>

<style>
.tooltip-inner {
    max-width: 550px;
    /* If max-width does not work, try using width instead */
    width: 450px;
		font-size: 8px;
}
</style>

<script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    schedulerLicenseKey: '0404885988-fcs-1582214203',
    plugins: [ 'resourceTimeGrid' ],
    timeZone: 'UTC',
    locale: 'es', // the initial locale
    //defaultView: 'resourceTimeGridFourDay',
    defaultView: 'resourceTimeGridDay',
    datesAboveResources: true,
    @if($now != null)
      defaultDate: '{{ $now }}',
    @endif
    scrollTime :  "08:00:00", //hora inicio
    allDaySlot: false,
    header: {
      left: 'prev,next',
      center: 'title',
      right: 'resourceTimeGridDay,resourceTimeGridFourDay'
    },
    views: {
      resourceTimeGridFourDay: {
        type: 'resourceTimeGrid',
        duration: { days: 4 },
        buttonText: '4 days'
      }
    },
		eventRender: function (info) {
			$(info.el).tooltip({ title: info.event.extendedProps.tooltip, html: true });
		},

    resources: [
      @foreach($operatingRooms as $operatingRoom)
      { id: '{{$operatingRoom->name}}'
        , title: '{{$operatingRoom->name}}'
        // , eventBackgroundColor: '{{$operatingRoom->color}}'
      },
      @endforeach
    ],
    events: [
      @foreach($current_activities as $act)
        { id: '1',
				  tooltip: '{!! $act->tooltip !!}',
          resourceId: '{{$act->pabellon}}',
          title: '{{$act->medico_especialidad_desc}}',
          start: '{{$act->fecha_inicio_intervencion}}',
          end: '{{$act->fecha_termino_intervencion}}'
          @foreach($specialties as $key => $specialty)
            @if($act->medico_especialidad_desc == $specialty->medico_especialidad_desc)
              ,color: '#{{$specialty->color}}'
            @endif
          @endforeach

        },
      @endforeach
    ]
  });

  calendar.render();
});


</script>

@endsection
