<table class="table table-sm table-borderer">
    <thead>
        <tr>
            <th>Id contrato</th>
            <th>Especialista</th>
            <th>Especialidad</th>
            <th>Actividad</th>
            <th>Horas Asignadas</th>
            <th>Horas Performance</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $programming as $row )
        <tr>
            <td>{{ $row->contract->contract_id }}</td>
            <td>{{ $row->rrhh->getFullNameAttribute() }}</td>
            <td>{{ $row->specialty->specialty_name }}</td>
            <td>{{ $row->activity->activity_name }}</td>
            <td>{{ $row->assigned_hour }}</td>
            <td>{{ $row->hour_performance }}</td>
            <td nowrap>
      				<a href="{{ route('ehr.hetg.medical_programming.edit', $row) }}"
      					class="btn btn-sm btn-outline-secondary">
      					<span class="fas fa-edit" aria-hidden="true"></span>
      				</a>
      				<form method="POST" action="{{ route('ehr.hetg.medical_programming.destroy', $row) }}" class="d-inline">
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

<form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.medical_programming.store') }}">
    @csrf
    @method('POST')

    <input type="hidden" id="year" name="year" value="{{$request->year}}"/>
    <input type="hidden" id="rut" name="rut" value="{{$request->rut}}"/>
    @if($contracts->count() > 0)
        <input type="hidden" id="contract_id" name="contract_id" value="{{$contracts->first()->id}}"/>
    @else
        <input type="hidden" id="contract_id" name="contract_id" value="{{$request->contract_id}}"/>
    @endif
    <input type="hidden" id="specialty_id" name="specialty_id" value="{{$request->specialty_id}}"/>

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
