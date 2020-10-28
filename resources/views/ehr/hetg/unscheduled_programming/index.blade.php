<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Contrato</th>
            <th>Especialista</th>
            @if($request->tipo == 1) <th>Especialidad</th> @endif
            @if($request->tipo == 2) <th>Profesión</th> @endif
            <th>Actividad</th>
            <th>Horas Asignadas</th>
            <th>Horas Performance</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $programming as $row )
        <tr>
            <td>{{ $row->contract->law }}</td>
            <td>{{ $row->rrhh->getFullNameAttribute() }}</td>
            @if($request->tipo == 1) <td>{{ $row->specialty->specialty_name }}</td> @endif
            @if($request->tipo == 2) <td>{{ $row->profession->profession_name }}</td> @endif
            <td>{{ $row->activity->activity_name }}</td>
            <td>{{ $row->assigned_hour }}</td>
            <td>{{ $row->hour_performance }}</td>
            <td nowrap>
      				{{-- <a href="{{ route('ehr.hetg.unscheduled_programming.edit', $row) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a> --}}
      				<form method="POST" action="{{ route('ehr.hetg.unscheduled_programming.destroy', $row) }}" class="d-inline">
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

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.unscheduled_programming.store') }}">
    @csrf
    @method('POST')

    <input type="hidden" id="year" name="year" value="{{$request->year}}"/>
    <input type="hidden" id="rut" name="rut" value="{{$request->rut}}"/>
    <input type="hidden" id="date" name="date" value="{{$date}}"/>
    <input type="hidden" id="tipo" name="tipo" value="{{$request->tipo}}"/>

    {{-- @if($contracts->count() > 0)
        1
        <input type="hidden" id="contract_id" name="contract_id" value="{{$contracts->first()->id}}"/>
    @else
        2
        <input type="hidden" id="contract_id" name="contract_id" value="{{$request->contract_id}}"/>
    @endif --}}
    <input type="hidden" id="contract_id" name="contract_id" value="{{$request->contract_id}}"/>

    <input type="hidden" id="specialty_id" name="specialty_id" value="{{$request->specialty_id}}"/>
    <input type="hidden" id="profession_id" name="profession_id" value="{{$request->profession_id}}"/>

    <div class="row">

      <fieldset class="form-group col">
          <label for="for_activity_id">Actividad</label>
          <select name="activity_id" id="for_activity_id" class="form-control selectpicker" required="" data-live-search="true" data-size="5">
            @foreach($activities as $activity)
              <option value="{{$activity->id}}">{{$activity->id}} - {{$activity->activity_name}}</option>
            @endforeach
          </select>
      </fieldset>

      <fieldset class="form-group col">
          <label for="for_assigned_hour">Horas Asignadas</label>
          <input type="text" class="form-control" id="for_assigned_hour" placeholder="" name="assigned_hour" required>
      </fieldset>

      <fieldset class="form-group col">
          <label for="for_hour_performance">Rdto. por Hora</label>
          <input type="text" class="form-control" id="for_hour_performance" placeholder="--" disabled name="hour_performance">
      </fieldset>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>
