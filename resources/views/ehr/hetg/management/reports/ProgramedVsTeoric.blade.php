@extends('layouts.app')

@section('title', 'Pabellon Reporte por Especialidad')

@section('content')

<h3 class="mb-3">Reporte uso de pabellón por especialidades</h3>

<form class="form-inline" method="post" action="{{ route('ehr.hetg.management.report.reportProgramedVsTeoric') }}">
	@csrf
	<div class="form-group mr-3">
		<label for="for_year_week">Semana</label>
		<input type="week" class="form-control mx-sm-3" name="year_week" value="{{ old('year_week') }}">
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

<div id="chartdiv"></div>

<div id="chartdivOperatingRoom"></div>

@endsection

@section('custom_js')

<!-- Styles -->
<style>
/* #chartdiv {
  width: 100%;
  height: 600px;
} */

#chartdivOperatingRoom {
  width: 100%;
  height: 600px;
}
</style>

<!-- Chart code -->
<script>
// am4core.ready(function() {
//
// // Themes begin
// am4core.useTheme(am4themes_animated);
// // Themes end
//
//
//
// var chart = am4core.create('chartdiv', am4charts.XYChart)
// chart.colors.step = 2;
//
// chart.legend = new am4charts.Legend()
// chart.legend.position = 'top'
// chart.legend.paddingBottom = 20
// chart.legend.labels.template.maxWidth = 95
//
// chart.scrollbarX = new am4core.Scrollbar();
// chart.scrollbarX.parent = chart.bottomAxesContainer;
//
// chart.scrollbarY = new am4core.Scrollbar();
// chart.scrollbarY.parent = chart.leftAxesContainer;
//
//
//
//
// // Add legend
// chart.legend = new am4charts.Legend();
//
// // Add cursor
// chart.cursor = new am4charts.XYCursor();
//
// var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
// xAxis.dataFields.category = 'category'
// xAxis.renderer.cellStartLocation = 0.1
// xAxis.renderer.cellEndLocation = 0.9
// xAxis.renderer.grid.template.location = 0;
// xAxis.renderer.labels.template.rotation = 25;
// xAxis.renderer.labels.template.fontSize = 10;
// xAxis.renderer.minGridDistance = 10; //adjust as needed
// xAxis.sortBySeries = "theoretical_duration";
//
// var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
// yAxis.min = 0;
//
// function createSeries(value, name) {
//     var series = chart.series.push(new am4charts.ColumnSeries())
//     series.dataFields.valueY = value
//     series.dataFields.categoryX = 'category'
// 		series.tooltipText = "{name}: [bold]{valueY}[/]";
//     series.name = name
//
// 		// series.columns.template.column.cornerRadiusTopLeft = 5;
// 		// series.columns.template.column.cornerRadiusTopRight = 5;
//
//     series.events.on("hidden", arrangeColumns);
//     series.events.on("shown", arrangeColumns);
//
//     var bullet = series.bullets.push(new am4charts.LabelBullet())
//     bullet.interactionsEnabled = false
//     bullet.dy = 30;
//     bullet.label.text = '{valueY}'
//     bullet.label.fill = am4core.color('#ffffff')
//
//     return series;
// }
//
// var lineSeries = chart.series.push(new am4charts.LineSeries());
// lineSeries.name = "Estimado";
// lineSeries.dataFields.valueY = "Estimado";
// lineSeries.dataFields.categoryX = "category";
// lineSeries.tooltipText = "{name}: [bold]{valueY}[/]";
//
// lineSeries.stroke = am4core.color("#fdd400");
// lineSeries.strokeWidth = 3;
// lineSeries.propertyFields.strokeDasharray = "lineDash";
// lineSeries.tooltip.label.textAlign = "middle";
// lineSeries.tooltip.label.background.fill = am4core.color("#fdd400");
//
// chart.data = [
// 	@foreach($array as $key => $element)
//     {
//         category: '{{$key}}',
// 				Estimado: {{$element['theoretical_duration']}},
// 				Ejecutado: {{$element['executed_duration']}},
// 				Programado: {{$element['programed_duration']}}
//     },
// 	@endforeach
// ]
//
//
// createSeries('Teórico', 'Teórico');
// createSeries('Ejecutado', 'Ejecutado');
// createSeries('Programado', 'Programado');
//
// function arrangeColumns() {
//
//     var series = chart.series.getIndex(0);
//
//     var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
//     if (series.dataItems.length > 1) {
//         var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
//         var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
//         var delta = ((x1 - x0) / chart.series.length) * w;
//         if (am4core.isNumber(delta)) {
//             var middle = chart.series.length / 2;
//
//             var newIndex = 0;
//             chart.series.each(function(series) {
//                 if (!series.isHidden && !series.isHiding) {
//                     series.dummyData = newIndex;
//                     newIndex++;
//                 }
//                 else {
//                     series.dummyData = chart.series.indexOf(series);
//                 }
//             })
//             var visibleCount = newIndex;
//             var newMiddle = visibleCount / 2;
//
//             chart.series.each(function(series) {
//                 var trueIndex = chart.series.indexOf(series);
//                 var newIndex = series.dummyData;
//
//                 var dx = (newIndex - trueIndex + middle - newMiddle) * delta
//
//                 series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
//                 series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
//             })
//         }
//     }
// }
//
// }); // end am4core.ready()



















am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdivOperatingRoom", am4charts.XYChart);

	chart.data = [
	@foreach($operatingRooms as $op => $operatingRoom)
		@foreach($OperatingRoomArray as $key => $OperatingRoom)
			{
				"year": '{{$operatingRoom->name}}',
				@foreach($OperatingRoom as $key2 => $specialty)
				Teorico: {{$specialty['avaliable_hours']}},
				@endforeach
			},
		@endforeach
	@endforeach
	]

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.grid.template.location = 0;


var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inside = true;
valueAxis.renderer.labels.template.disabled = true;
valueAxis.min = 0;

// Create series
function createSeries(field, name) {

  // Set up series
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.name = name;
  series.dataFields.valueY = field;
  series.dataFields.categoryX = "year";
  series.sequencedInterpolation = true;

  // Make it stacked
  series.stacked = true;

  // Configure columns
  series.columns.template.width = am4core.percent(60);
  series.columns.template.tooltipText = "[bold]{name}[/]\n[font-size:14px]{categoryX}: {valueY}";

  // Add label
  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
  labelBullet.label.text = "{valueY}";
  labelBullet.locationY = 0.5;
  labelBullet.label.hideOversized = true;

  return series;
}

createSeries("Teorico", "Teorico");
createSeries("Ejecutado", "Ejecutado");
createSeries("Programado", "Programado");
// createSeries("lamerica", "Latin America");
// createSeries("meast", "Middle-East");
// createSeries("africa", "Africa");



// Legend
chart.legend = new am4charts.Legend();

}); // end am4core.ready()

</script>


@endsection

@section('custom_js_head')

<script src='{{asset('assets/amcharts/js/core.js')}}'></script>
<script src='{{asset('assets/amcharts/js/charts.js')}}'></script>
<script src='{{asset('assets/amcharts/js/animated.js')}}'></script>

@endsection
