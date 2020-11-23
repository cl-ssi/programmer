@extends('layouts.app')

@section('title', 'Detalle por profesional')

@section('content')

<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- <h3 class="mb-3">Programación de {{ $profesional->name }} <small>{{ $profesional->rut }}</small> </h3> -->

<!-- <div class="row">
	<div class="col">
		<form method="post" action="{{ route('ehr.hetg.management.report.by_profesional') }}">
			@csrf
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Profesional</span>
				</div>



				<div class="input-group-prepend">
					<span class="input-group-text"></span>
				</div>



				<div class="input-group-append">

				</div>

			</div>
        </form>
	</div>
</div> -->

<form method="post" action="{{ route('ehr.hetg.management.report.by_profesional') }}">
	@csrf
<div class="row">
		<fieldset class="form-group col-4">
			<label for="for_rut">Profesional</label>
			<select name="rut" class="form-control selectpicker" data-live-search="true" for="for_rut">
				@foreach($rrhh as $user)
				<option value="{{ $user->rut }}" {{ ($profesional->rut == $user->rut)?'selected':'' }}>
					{{ $user->fullName }} ({{ $user->job_title }})
				</option>
				@endforeach
			</select>
		</fieldset>

		<fieldset class="form-group col-6">
			<label for="for_rut">Fecha</label>
			<input type="week" class="form-control" name="year_week" value="{{ $now->year }}-W{{ ($now->weekOfYear < 10)?'0'.$now->weekOfYear:$now->weekOfYear}}">
		</fieldset>

		<fieldset class="form-group col-2">
			<br>
			<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
		</fieldset>
</div>
</form>


<h3 class="mt-3">Semana del {{ $now->startOfWeek()->format('d-m-Y') }} al
				{{ $now->endOfWeek()->format('d-m-Y') }}</h3>

<div class="row">
	<div class="col-4">

		<h4>Contratos</h4>
		<table class="table table-sm table-bordered" >
			<thead>
				<tr>
					<th>Contratos</th>
					<th>Ley</th>
					<th>Horas</th>
					<th>Turno</th>
				</tr>
			</thead>
			<tbody class="text-center">
				@foreach($contracts as $contract)
				@if($contract->weekly_hours == 28)
				<tr class="text-muted">
					<td>{{ $contract->contract_id }}</td>
					<td>{{ $contract->law }}</td>
					<td>{{ $contract->weekly_hours }}</td>
					<td>{{ $contract->shift_system }}</td>
				</tr>
				@else
				<tr>
					<td>{{ $contract->contract_id }}</td>
					<td>{{ $contract->law }}</td>
					<td>{{ $contract->weekly_hours }}</td>
					<td>{{ $contract->shift_system }}</td>
				</tr>
				@endif
				@endforeach
			</tbody>
		</table>

		<h4>Resumen</h4>

		<table class="table table-bordered">
			<tbody>
				<tr>
					<th>Hrs. Contratadas Pb</th>
					<td class="text-right">{{ $total_contratadas }}</td>
				</tr>
				<tr>
					<th>Hrs. Programadas</th>
					<td class="text-right">{{$total_programadas}}</td>
				</tr>
				<tr>
					<th>Hrs. Ejecutadas</th>
					<td class="text-right">{{ $total_ejecutadas }}</td>
				</tr>
				<tr class="table-success">
					<th>Horas Habil</th>
					<td class="text-right">{{ $total_habil }}</td>
				</tr>
				<tr class="table-warning">
					<th>Horas Inhábil</th>
					<td class="text-right">{{ $total_inhabil }}</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="col-8">
		<h4>Programación semanal</h4>
		<table class="table table-sm table-bordered" >
			<thead>
				<tr>
					<th>Contratos</th>
					<th>Especialidad</th>
					<th>Actividad</th>
					<th>Horas asignadas</th>
				</tr>
			</thead>
			<tbody class="small">
				@foreach($programacion_pabellon as $program)
					<tr>
						<td>{{ $program->contract->contract_id }}</td>
						<td>{{ $program->specialty->specialty_name }}</td>
						<td>{{ $program->activity->activity_name }}</td>
						<td class="text-center">{{ gmdate("H:i:s", $program->duration*60*60) }}</td>
					</tr>
				@endforeach
				@foreach($programacion_otras_actividades as $program)
					<tr class="text-muted">
						<td>{{ $program->contract_id }}</td>
						<td>{{ $program->specialty->specialty_name }}</td>
						<td>{{ $program->activity->activity_name }}</td>
						<td class="text-center">{{ gmdate("H:i:s", $program->duration*60*60) }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<h4>Ejecutadas</h4>
		<table class="table table-sm table-bordered" >
			<thead>
				<tr>
					<th>Pabellón</th>
					<th>Especialidad</th>
					<th>Categoria</th>
					<th>Hora Inicio</th>
					<th>T° intevención</th>
					<th>T° estimado</th>
				</tr>
			</thead>
			<tbody class="small">
				@foreach($current_activities as $activity)
					<tr class="{{ ($activity->habil)?'':'table-warning' }}">
						<td>{{ $activity->operating_room }}</td>
						<td>{{ $activity->medic_specialty_desc }}</td>
						<td>{{ $activity->surgery_category_desc }}</td>
						<td class="text-center">{{ $activity->intervention_start_date->format('H:i:s') }}</td>
						<td class="text-center">{{ $activity->ActivityDurationHuman }}</td>
						<td class="text-center">{{ gmdate("H:i:s", $activity->estimated_intervention_time*60) }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>

<div id='calendar'></div>

@endsection

@section('custom_js')

<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
	date = '{{ $now->startOfWeek()->format("Y-m-d") }}';

	var calendarEl = document.getElementById('calendar');

	var calendar = new FullCalendar.Calendar(calendarEl, {
		schedulerLicenseKey: '0404885988-fcs-1582214203',
		locale: 'es',
		plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
		defaultView: 'timeGridWeek',

		eventRender: function (info) {
			$(info.el).tooltip({ title: info.event.extendedProps.tooltip, html: true });
	  	},

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

		events: [
			@foreach($current_activities as $activity)
			{
				//title: 'Programado.',
				tooltip: '{!! $activity->procedimientos !!}',
				start: '{{ $activity->intervention_start_date }}',
				end: '{{ $activity->intervention_end_date }}',
				color: '{{ ($activity->habil)?'#8fd19e':'#ffe9a6' }}'
			},
			@endforeach
		]
	});

	calendar.render();
});

</script>

<link href="{{asset('assets/fullcalendar/packages/core/main.css')}}" rel='stylesheet' />
<link href="{{asset('assets/fullcalendar/packages/daygrid/main.css')}}" rel='stylesheet' />
<link href="{{asset('assets/fullcalendar/packages/timegrid/main.css')}}" rel='stylesheet' />
<link href="{{asset('assets/fullcalendar/packages/list/main.css')}}" rel='stylesheet' />
<!-- <link href="{{asset('assets/fullcalendar/css/style.css')}}" rel='stylesheet' />  -->

<script src="{{ asset('assets/fullcalendar/packages/core/main.js') }}"></script>
<script src="{{asset('assets/fullcalendar/packages/interaction/main.js')}}"></script>
<script src="{{asset('assets/fullcalendar/packages/daygrid/main.js')}}"></script>
<script src="{{asset('assets/fullcalendar/packages/timegrid/main.js')}}"></script>
<script src="{{asset('assets/fullcalendar/packages-premium/resource-common/main.js')}}"></script>
<script src="{{asset('assets/fullcalendar/packages-premium/resource-daygrid/main.js')}}"></script>
<script src="{{asset('assets/fullcalendar/packages-premium/resource-timegrid/main.js')}}"></script>
<script src="{{asset('assets/fullcalendar/packages/core/locales/es.js')}}"></script>
@endsection

@section('custom_js_head')

@endsection
