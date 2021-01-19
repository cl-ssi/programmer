@extends('layouts.app')

@section('title', 'Pabellon Reporte por Especialidad')

@section('content')

@include('ehr.hetg.management.reports.wsInterventions', ['executedActivities' => $executedActivities] )

<h3 class="mb-3">Reporte uso de pabellón por especialidades</h3>

<form class="form-inline" method="post" action="{{ route('ehr.hetg.management.report.specialty') }}">
	@csrf
	<div class="form-group mr-3">
		<label for="for_year_week">Semana</label>
		<input type="week" class="form-control mx-sm-3" name="year_week"
			value="{{ old('year_week') }}">
	</div>

	<i class="fas fa-arrows-alt-h mr-3 ml-3"></i>

	<div class="form-group ml-3">
		<label for="for_from">Desde</label>
		<input type="date" class="form-control mx-sm-3" id="for_from" name="from"
			value="{{ old('from') }}">
	</div>

	<div class="form-group">
		<label for="for_to">Hasta</label>
		<input type="date" class="form-control mx-sm-3" id="for_to" name="to"
			value="{{ old('to') }}">
	</div>

	<div class="form-group">
		<button type="submit" name="btn_buscar" class="btn btn-primary">Buscar</button>
	</div>
</form>


<h3 class="mt-3 mb-3">Semana del {{ $now->startOfWeek()->format('d-m-Y') }} al {{ $now->endOfWeek()->format('d-m-Y') }}</h3>

<table class="table table-sm table-bordered">
	<thead>
		<tr >
			<th>Especialidad</th>
			<!-- <th>Hrs.Contratadas</th> -->
			<th>Hrs.Teórico</th>
			<th>Hrs.Programadas (YANI)</th>
			<th>Hrs.Ejecutadas (YANI)</th>
			<th>Hrs.Habil</th>
			<th>Hrs.Inhábil</th>
			<th></th>
		</tr>
	</thead>
	<tbody class="small">
		@foreach($resumen as $codigo_especialidad => $especialidad)
			<tr>
				<td>{{ $especialidad['nombre_especialidad']->specialty_name }}</td>
				<td class="text-center">{{ $especialidad['horas_teorico'] }}</td>
				<td class="text-center">{{ $especialidad['horas_programadas'] }}</td>
				<td class="text-center"><b><font color="#67b7dc" style="text-shadow: 0.7px 0.7px 0.7px black;">{{ $especialidad['horas_ejecutadas'] }}</font></b></td>
				<td class="table-success text-center">{{ $especialidad['horas_habiles'] }}</td>
				<td class="table-warning text-center">{{ $especialidad['horas_inhabiles'] }}</td>
				<td><button class="btn btn-info btn-sm" id="btn_{{ $codigo_especialidad }}">Ver detalle</button></td>
			</tr>
		@endforeach

	</tbody>
</table>


<div id="move"></div>
@foreach($horas_ejecutadas as $codigo_especialidad => $medicos)
<table class="table table-sm table-bordered" style="display:none" id="table_{{ $codigo_especialidad }}">
	<thead>
		<tr >
			<th></th>
			<th>Correlativo</th>
			<th>Nombre</th>
			<th>Profesión</th>
			<th>Pabellón</th>
			<th>Categoría</th>
			<th>T.Estimado</th>
			<th>Hrs.</th>
		</tr>
	</thead>
	<tbody class="small">
		@foreach($medicos as $medico)
		<tr>
			<td><i class="fas fa-flag"></i></td>
			<td>{{ $medico->correlative }}</td>
			<td>
			<form class="form-inline" method="post" action="{{ route('ehr.hetg.management.report.by_profesional') }}">
				@csrf
				<input type="hidden" value="{{ $medico->medic_rut }}" name="rut">
				<input type="hidden" value="{{ $now->year }}-W{{ ($now->weekOfYear < 10)?'0'.$now->weekOfYear:$now->weekOfYear}}" name="year_week">
				<button class="btn btn-link" style="padding: 0px; font-size: smaller">{{ $medico->medic_name}}
			</form>
			</td>
			<td>{{ $medico->profession }}</td>
			<td>{{ $medico->operating_room }}</td>
			<td>{{ $medico->surgery_category_desc }}</td>
			<td>{{ $medico->estimated_intervention_time }}</td>
			<td>{{ $medico->ActivityDurationHuman }}</td>



		</tr>
		@endforeach
	</tbody>
</table>
@endforeach


<div id="chartdiv"></div>

@endsection

@section('custom_js')
<script type="text/javascript">
    $(document).ready(function(){
		@foreach($resumen as $cod_especialidad => $especialidad)
			$("#btn_{{ $cod_especialidad }}").click(function(){
					$("#table_{{ $cod_especialidad }}").toggle();

					$(window).scrollTop($('#move').offset().top);
			});
		@endforeach
    });
</script>

<style>
	#chartdiv_expirados {
	  width: 100%;
	  height: 500px;
	}
</style>
<script type="text/javascript">
    $('.custom-file-input').on('change', function(event) {
    var inputFile = event.currentTarget;
    $(inputFile).parent()
        .find('.custom-file-label')
        .html(inputFile.files[0].name);
    });
</script>






<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart3D);

// Export
chart.exporting.menu = new am4core.ExportMenu();

//scrollbars
chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarX.parent = chart.bottomAxesContainer;
chart.scrollbarY = new am4core.Scrollbar();
chart.scrollbarY.parent = chart.leftAxesContainer;

// // Add legend and cursor
// chart.legend = new am4charts.Legend();
chart.cursor = new am4charts.XYCursor();

// Data for both series
var data = [

@foreach($resumen as $especialidad)
{
	"year": "{{ $especialidad['nombre_especialidad']->specialty_name }}",
	"Hrs.Teorico": '{{$especialidad['horas_teorico']}}',
	"Hrs.Ejecutadas": ' {{$especialidad['horas_ejecutadas']}}',
	"Hrs.Programadas": ' {{$especialidad['horas_programadas']}}'
},
@endforeach
];

/* Create axes */
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.rotation = 45;
categoryAxis.renderer.labels.template.fontSize = 8;

/* Create value axis */
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

/* Create series */
var columnSeries = chart.series.push(new am4charts.ColumnSeries3D());
columnSeries.name = "Hrs.Ejecutadas";//"Hrs.Contratadas";
columnSeries.dataFields.valueY = "Hrs.Ejecutadas";//"Hrs.Contratadas";
columnSeries.dataFields.categoryX = "year";

// Make it stacked
columnSeries.stacked = true;
// columnSeries.clustered = false;

columnSeries.columns.template.tooltipText = "[#fff font-size: 10px]{name} in {categoryX}:\n[/][#fff font-size: 10px]{valueY}[/] [#fff]{additional}[/]";
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";




/* Create series */
var columnSeries = chart.series.push(new am4charts.ColumnSeries3D());
columnSeries.name = "Hrs.Programadas";//"Hrs.Contratadas";
columnSeries.dataFields.valueY = "Hrs.Programadas";//"Hrs.Contratadas";
columnSeries.dataFields.categoryX = "year";

// Make it stacked
columnSeries.stacked = true;
// columnSeries.clustered = false;

columnSeries.columns.template.tooltipText = "[#fff font-size: 10px]{name} in {categoryX}:\n[/][#fff font-size: 10px]{valueY}[/] [#fff]{additional}[/]"
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";


/* Create series */
var columnSeries = chart.series.push(new am4charts.ColumnSeries3D());
columnSeries.name = "Hrs.Teorico";//"Hrs.Contratadas";
columnSeries.dataFields.valueY = "Hrs.Teorico";//"Hrs.Contratadas";
columnSeries.dataFields.categoryX = "year";

// Make it stacked
columnSeries.stacked = true;
// columnSeries.clustered = false;

columnSeries.columns.template.tooltipText = "[#fff font-size: 10px]{name} in {categoryX}:\n[/][#fff font-size: 10px]{valueY}[/] [#fff]{additional}[/]"
columnSeries.columns.template.propertyFields.fillOpacity = "fillOpacity";
columnSeries.columns.template.propertyFields.stroke = "stroke";
columnSeries.columns.template.propertyFields.strokeWidth = "strokeWidth";
columnSeries.columns.template.propertyFields.strokeDasharray = "columnDash";
columnSeries.tooltip.label.textAlign = "middle";



// var lineSeries = chart.series.push(new am4charts.LineSeries());
// lineSeries.name = "Hrs.Teorico";//"Hrs.Ejecutadas";
// lineSeries.dataFields.valueY = "Hrs.Teorico";//"Hrs.Ejecutadas";
// lineSeries.dataFields.categoryX = "year";
//
// lineSeries.stroke = am4core.color("#fdd400");
// lineSeries.strokeWidth = 3;
// lineSeries.propertyFields.strokeDasharray = "lineDash";
// lineSeries.tooltip.label.textAlign = "middle";
//
//
//
//
// var bullet = lineSeries.bullets.push(new am4charts.Bullet());
// bullet.fill = am4core.color("#fdd400"); // tooltips grab fill from parent by default
// bullet.tooltipText = "[#fff font-size: 15px]{name} in {categoryX}:\n[/][#fff font-size: 20px]{valueY}[/] [#fff]{additional}[/]"
// var circle = bullet.createChild(am4core.Circle);
// circle.radius = 4;
// circle.fill = am4core.color("#fff");
// circle.strokeWidth = 3;

chart.data = data;

}); // end am4core.ready()
</script>


@endsection

@section('custom_js_head')

<script src='{{asset('assets/amcharts/js/core.js')}}'></script>
<script src='{{asset('assets/amcharts/js/charts.js')}}'></script>
<script src='{{asset('assets/amcharts/js/animated.js')}}'></script>

@endsection
