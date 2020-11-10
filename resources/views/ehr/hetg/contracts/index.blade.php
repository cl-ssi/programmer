@extends('layouts.app')

@section('title', 'Listado de Contratos')

@section('content')

<h3 class="mb-3">Listado de Contratos</h3>

<a class="btn btn-primary mb-3" href="{{ route('ehr.hetg.contracts.create') }}">
    <i class="fas fa-plus"></i> Agregar nuevo
</a>

<form method="GET" class="form-horizontal" action="{{ route('ehr.hetg.contracts.index') }}">
  <div class="input-group mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text">Año contrato</span>
      </div>

      {{-- <input type="date" class="form-control" id="for_year" name="year"
          value="{{ ($request->get('year'))?$request->get('year'):date('Y-m-d') }}"
          required > --}}
      <select name="year" id="for_year" class="form-control">
        <option value="2020" {{ $request->get('year') == "2020" ? 'selected' : '' }}>2020</option>
        <option value="2021" {{ $request->get('year') == "2021" ? 'selected' : '' }}>2021</option>
        <option value="2022" {{ $request->get('year') == "2022" ? 'selected' : '' }}>2022</option>
        <option value="2023" {{ $request->get('year') == "2023" ? 'selected' : '' }}>2023</option>
        <option value="2024" {{ $request->get('year') == "2024" ? 'selected' : '' }}>2024</option>
        <option value="2025" {{ $request->get('year') == "2025" ? 'selected' : '' }}>2025</option>
      </select>

      <div class="input-group-append">
          <button type="submit" class="btn btn-primary" id="button"><i class="fas fa-search"></i> Buscar</button>
      </div>
  </div>
</form>

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Trabajador</th>
            <th>Especialista</th>
            <th>Ley</th>
            <th>Correlativo contrato</th>
            <th>Horas Semanales</th>
            <th>Servicio</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $contracts as $contract )
        <tr>
            <td>{{ $contract->id }}</td>
            <td>{{ $contract->rrhh->getFullNameAttribute() }}</td>
            <td>{{ $contract->law }}</td>
            <td>{{ $contract->contract_id }}</td>
            <td>{{ $contract->weekly_hours }}</td>
            <td>{{ $contract->service->service_name }}</td>
            <td>
      				<a href="{{ route('ehr.hetg.contracts.edit', $contract) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('ehr.hetg.contracts.destroy', $contract) }}" class="d-inline">
      					@csrf
      					@method('DELETE')
      					<button type="submit" class="btn btn-outline-secondary btn-sm" onclick="return confirm('¿Está seguro de eliminar la información?');">
      						<span class="fas fa-trash-alt" aria-hidden="true"></span>
      					</button>
      				</form>
      			</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('custom_js')

@endsection
