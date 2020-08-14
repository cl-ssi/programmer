@extends('layouts.app')

@section('title', 'Pabellon Producción Semanal')

@section('content')

<h3 class="mb-3">Reporte de producción urgencias</h3>

<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{ route('ehr.hetg.management.report.report1') }}">
			@csrf
						<div class="input-group mb-3">

              <div class="input-group-prepend">
								<span class="input-group-text">Desde</span>
							</div>
              <input type="date" class="form-control" id="for_from" name="from" value="{{ $from }}">


              <div class="input-group-prepend">
								<span class="input-group-text">Hasta</span>
							</div>
              <input type="date" class="form-control" id="for_to" name="to" value="{{ $to }}">

							<div class="input-group-append">
								<button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
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
    </tr>
  </thead>
  <tbody>
    @foreach($average_total as $key => $item)
    <tr>
      <td>
        <span class='badge badge-primary' style='background-color: #{{$item->color}};'><font color="black">{{$item->medico_especialidad_desc}}</font></span>
      </td>
      <td>{{$item->total_horas}}</td>
			<td>{{$item->prom}}%</td>
			<td>{{$item->promedio_duracion_intervencion}} hrs.</td>
    </tr>
    @endforeach
  </tbody>
</table>

<hr><h4>Detalle</h4>

<table class="table table-sm table-bordered small">
  <thead>
    <tr>
      <th scope="col">Ley</th>
      <th scope="col">H.Sem.</th>
			<th scope="col">Año</th>
			<th scope="col">Mes</th>
      <th scope="col">Semana</th>
			<th scope="col">Especialidad</th>
			<th scope="col">Rut</th>
			<th scope="col">Médico</th>
			<th scope="col" nowrap>Total Hrs.</th>
    </tr>
  </thead>
  <tbody>
    @foreach($executed_activities as $key => $item)
    <tr>
      <td nowrap>{{$item->law}}</td>
			<td>{{$item->weekly_hours}}</td>
			<td>{{$item->anho}}</td>
      <td>{{$item->mes}}</td>
			<td>{{$item->Semana}}</td>
			<!-- <td>{{$item->medico_especialidad_desc}}</td> -->
			<td><span class='badge badge-primary' style='background-color: #{{$item->color}};'><font color="black">{{$item->medico_especialidad_desc}}</font></span></td>
			<td>{{$item->rut}}</td>
			<td>{{$item->nombre}}</td>
			<td>{{$item->total_horas}}</td>
    </tr>
    @endforeach
  </tbody>
</table>




@endsection

@section('custom_js')

@endsection

@section('custom_js')

@endsection

@section('custom_js_head')

@endsection
