@extends('layouts.app')

@section('title', 'Pabellon Producción Semanal')

@section('content')

<h3 class="mb-3">Reporte de producción semanal</h3>

<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{ route('ehr.hetg.management.report.weekly') }}">
			@csrf
            <!-- <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="inlineFormInput">Fecha</label>
                    <input type="week" class="form-control" name="year_week" value="{{ $now->year }}-W{{ ($now->weekOfYear < 10)?'0'.$now->weekOfYear:$now->weekOfYear}}">
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                </div>
            </div> -->
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Pabellón</span>
							</div>

							<select name="operatingRoom" class="form-control selectpicker" for="for_supplier">
								@foreach($operatingRooms as $operatingRoom)
								<option value="{{ $operatingRoom->name }}" {{ ($operatingRoom->name == $operatingRoom_name)?'selected':'' }}>
									{{$operatingRoom->description}}
								</option>
								@endforeach
							</select>

							<div class="input-group-prepend">
								<span class="input-group-text">Fecha</span>
							</div>
							<input type="week" class="form-control" name="year_week" value="{{ $now->year }}-W{{ ($now->weekOfYear < 10)?'0'.$now->weekOfYear:$now->weekOfYear}}">

							<div class="input-group-append">
								<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
							</div>

						</div>
        </form>

		<h3 class="mt-3 mb-3">Semana del {{ $now->startOfWeek()->format('d-m-Y') }} al {{ $now->endOfWeek()->format('d-m-Y') }}</h3>

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
	date = '{{ $now->startOfWeek()->format("Y-m-d") }}';
	var calendarEl = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarEl, {
  //var tooltipValue = '';
	schedulerLicenseKey: '0404885988-fcs-1582214203',
	plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
	defaultView: 'timeGridWeek',
	//defaultDate: '2020-02-24',
	defaultDate: date,
	header:false,
	editable: false,
	selectable: true,
	eventLimit: true, // allow "more" link when too many events
	header: {
	  left: 'prev,next today',
	  center: 'title',
	  right: 'dayGridMonth,timeGridWeek,timeGridDay'
	},
	allDaySlot: false,
	slotEventOverlap: true, //
	firstDay: 1, //lunes
	scrollTime :  "08:00:00", //hora inicio
	navLinks: true, // can click day/week names to navigate views
	selectMirror: true,

	eventRender: function (info) {
		$(info.el).tooltip({ title: info.event.extendedProps.tooltip, html: true });
		},

	events: [
		@foreach($current_activities as $activity)
		{
			tooltip: '{!! $activity->tooltip !!}',
			title: '{{ $activity->correlativo }}',
			start: '{{ $activity->fecha_inicio_intervencion }}',
			end: '{{ $activity->fecha_termino_intervencion }}',
			// color: '{{ ($activity->habil)?'#8fd19e':'#ffe9a6' }}'
			@foreach($specialties as $key => $specialty)
				@if($activity->medico_especialidad_desc == $specialty->medico_especialidad_desc)
					color: '#{{$specialty->color}}'
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

@section('custom_js')

@endsection

@section('custom_js_head')

<link href='{{asset('assets/fullcalendar/packages/core/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/daygrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/timegrid/main.css')}}' rel='stylesheet' />
<link href='{{asset('assets/fullcalendar/packages/list/main.css')}}' rel='stylesheet' />
<!-- <link href='{{asset('assets/fullcalendar/css/style.css')}}' rel='stylesheet' />  -->

<script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages/interaction/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages/timegrid/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages-premium/resource-common/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages-premium/resource-daygrid/main.js')}}'></script>
<script src='{{asset('assets/fullcalendar/packages-premium/resource-timegrid/main.js')}}'></script>

@endsection
