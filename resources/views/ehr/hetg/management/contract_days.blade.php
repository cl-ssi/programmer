<br />
<table class="table table-sm table-borderer">
    <thead>
        <tr>
            {{-- <th>Especialista</th> --}}
            <th>Ley</th>
            <th>Correlativo contrato</th>
            <th>Horas Semanales</th>
            <th>Días Feriados legales</th>
            <th>Días descanso compensatorio</th>
            <th>Días permisos administrativos</th>
            <th>Días congreso o capacitación</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $contracts as $contract )
        <tr>
            {{-- <td>{{ $contract->rrhh->getFullNameAttribute() }}</td> --}}
            <td>{{ $contract->law }}</td>
            <td>{{ $contract->contract_id }}</td>
            <td>{{ $contract->weekly_hours }}</td>
            <td>{{ $contract->legal_holidays }}</td>
            <td>{{ $contract->compensatory_rest }}</td>
            <td>{{ $contract->administrative_permit }}</td>
            <td>{{ $contract->training_days }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- <h3 class="mb-3">Ingreso detalle</h3> --}}
<hr />

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.theoretical_programming.store') }}">
    @csrf
    @method('POST')

    @if($contracts->count() != 0)
        <input type="hidden" class="form-control" id="for_rut" name="rut" value="{{$contracts->first()->rut}}">
        <input type="hidden" class="form-control" id="for_year" name="year" value="{{$request->year}}">
    @endif

    <div class="row">
        <fieldset class="form-group col">
            <label for="for_contract_day_type">Tipo</label>
            <select name="contract_day_type" id="contract_day_type" class="form-control" required="">
              <option value="legal_holidays">Días Feriados legales</option>
              <option value="compensatory_rest">Días descanso compensatorio</option>
              <option value="administrative_permit">Días permisos administrativos</option>
              <option value="training_days">Días congreso o capacitación</option>
            </select>
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_start_date">Fecha inicio</label>
            <input type="date" class="form-control" id="for_start_date" name="start_date" required >
        </fieldset>

        <fieldset class="form-group col">
            <label for="for_end_date">Fecha término</label>
            <input type="date" class="form-control" id="for_end_date" name="end_date" required >
        </fieldset>

        <fieldset class="form-group col-auto">
            <br />
            <button type="submit" class="btn btn-primary">Guardar</button>
        </fieldset>
    </div>
</form>

<br />

<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Fecha inicio</th>
            <th>Fecha término</th></th>
            <th>Días</th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $contract_days as $contract_day )
        <tr>
            <td>{{ $contract_day->contract_day_type }}</td>
            <td>{{ Carbon\Carbon::parse($contract_day->start_date)->format('d-m-Y') }}</td>
            <td>{{ Carbon\Carbon::parse($contract_day->end_date)->format('d-m-Y') }}</td>
            <td>{{ Carbon\Carbon::parse($contract_day->start_date)->diffInDays($contract_day->end_date) + 1 }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
