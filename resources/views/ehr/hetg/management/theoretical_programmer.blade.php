@extends('layouts.app')

@section('title', 'Programación de Horario Teórico')

@section('content')

<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css"/>

<link href='{{asset('assets/fullcalendar/packages/core/main.css')}}' rel='stylesheet'/>
<link href='{{asset('assets/fullcalendar/packages/daygrid/main.css')}}' rel='stylesheet'/>
<link href='{{asset('assets/fullcalendar/packages/timegrid/main.css')}}' rel='stylesheet'/>
<link href='{{asset('assets/fullcalendar/packages/list/main.css')}}' rel='stylesheet'/>

<script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'></script>

<style type="text/css" rel="stylesheet">
#page-loader {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 1000;
background: #FFF none repeat scroll 0% 0%;
z-index: 99999;
}
#page-loader .preloader-interior {
display: block;
position: relative;
left: 50%;
top: 50%;
width: 189px;
height: 171px;
margin: -75px 0 0 -75px;
background-image: url("{{asset('images/logo_rgb.png')}}");
-webkit-animation: heartbeat 1s infinite;
}

#page-loader .preloader-interior:before {
content: "";
position: absolute;
top: 5px;
left: 5px;
right: 5px;
bottom: 5px;
-webkit-animation: heartbeat 1s infinite;
}

@keyframes heartbeat
{
  0%{transform: scale( .75 );}
  20%{transform: scale( 1 );}
  40%{transform: scale( .75 );}
  60%{transform: scale( 1 );}
  80%{transform: scale( .75 );}
  100%{transform: scale( .75 );}
}

</style>

<h3 class="mb-3">Programación de Horario Teórico.</h3>

<form method="GET" id="form" class="form-horizontal" action="{{ route('ehr.hetg.theoretical_programming.index') }}">

  {{-- <input type="hidden" id="date" name="date"/>
  <input type="hidden" id="year" name="year" value="{{$request->year}}"/>
  <input type="hidden" id="rut" name="rut" value="{{$request->rut}}"/>
</form>

<form method="GET" id="form" class="form-horizontal" action="{{ route('ehr.hetg.calendar_programming.index') }}"> --}}
  <input type="hidden" id="date" name="date"/>
  <div class="row">
    <fieldset class="form-group col-3">
        <label for="for_unit_code">Año</label>
        <select name="year" id="for_year" class="form-control" required="" onchange="this.form.submit()">
          <option value="2020" {{ 2020 == $request->year ? 'selected' : '' }}>2020</option>
          <option value="2021" {{ 2021 == $request->year ? 'selected' : '' }}>2021</option>
          <option value="2022" {{ 2022 == $request->year ? 'selected' : '' }}>2022</option>
          <option value="2023" {{ 2023 == $request->year ? 'selected' : '' }}>2023</option>
          <option value="2024" {{ 2024 == $request->year ? 'selected' : '' }}>2024</option>
          <option value="2025" {{ 2025 == $request->year ? 'selected' : '' }}>2025</option>
        </select>
    </fieldset>

    <fieldset class="form-group col">
        <label for="for_rut">Especialista</label>
        <select name="rut" id="rut" class="form-control selectpicker" required="" onchange="this.form.submit()" data-live-search="true" data-size="5">
          <option>--</option>
          @foreach($rrhhs as $rrhh)
            <option value="{{$rrhh->rut}}" {{ $rrhh->rut == $request->rut ? 'selected' : '' }}>{{$rrhh->getFullNameAttribute()}}</option>
          @endforeach
        </select>
    </fieldset>

    <fieldset class="form-group col">
        <label for="for_contract_id">Contrato</label>
        <select name="contract_id" id="for_contract_id" class="form-control" required="" onchange="this.form.submit()">
            @foreach($contracts as $contract)
              <option value="{{$contract->id}}" {{ $contract->id == $request->contract_id ? 'selected' : '' }}>{{$contract->law}}</option>
            @endforeach
        </select>
    </fieldset>

    <fieldset class="form-group col">
        <label for="for_specialty_id">Especialidad</label>
        <select name="specialty_id" id="for_specialty_id" class="form-control selectpicker" required="" data-live-search="true" data-size="5" onchange="this.form.submit()">
          @foreach($specialties as $specialty)
            <option value="{{$specialty->id}}" {{ $specialty->id == $request->specialty_id ? 'selected' : '' }}>{{$specialty->specialty_name}}</option>
          @endforeach
        </select>
    </fieldset>

    <fieldset class="form-group col">
        <label for="for_contract_id">Hrs</label><br />
        @if($contracts->count() > 0)

            <span id="disponible_contrato"></span> /
            <b><span id="total_contrato">{{$contracts->first()->weekly_hours}}</span></b>
        @endif
    </fieldset>

  </div>


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Programable</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">No programable</a>
  </li>
</ul>


<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

      <br />

      <div align="right">
        <p>
          <input name="date2" type="date" onchange="this.form.submit()">
          <button id='prev'>Anterior</button>
          <button id='next'>Próximo</button>
        </p>
      </div>

      </form>

        <div id='wrap'>

        <div id='external-events'>
            <div id='external-events-list'>

                <small>ACTIVIDADES</small>

                @foreach ($activities as $key => $activity)
                    <div class='fc-event' data-event='{"title":"{{$activity->activity_name}}",
                                                       "id":"{{$activity->id}}", "description":"teorico"}'>
                        <small>{{$activity->activity_name}}: <span id="{{$activity->id}}"></span></small>
                    </div>
                @endforeach

                <small>DÌAS ADMINISTRATIVOS</small>

                @foreach ($permisos_administrativos as $key => $permiso_administrativo)
                    <div class='fc-event' data-event='{"title":"{{$key}}","id":"", "description":"{{$key}}", "color": "#A6C6F1"}'>
                        <small>{{$key}}: <span id="{{$key}}"></span></small>
                    </div>
                @endforeach

            </div>
        </div>


        <div id='calendar'></div>
        <div style='clear:both'></div>
        <div id="dialog" title="Basic dialog">
          <p>Seleccione el tipo de permiso:</p>
        </div>

        </div>

  </div>

  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

      <br />
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

      {{-- formulario ingreso no programable --}}

      <form method="POST" class="form-horizontal" action="{{ route('ehr.hetg.medical_programming.store') }}">
          @csrf
          @method('POST')

          <input type="hidden" id="year" name="year" value="{{$request->year}}"/>
          <input type="hidden" id="rut" name="rut" value="{{$request->rut}}"/>
          <input type="hidden" id="contract_id" name="contract_id" value="{{$request->contract_id}}"/>
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
                <input type="text" class="form-control" id="for_hour_performance" placeholder="" name="hour_performance">
            </fieldset>
          </div>

          <button type="submit" class="btn btn-primary">Guardar</button>

      </form>

  </div>
</div>




    <div id="page-loader" style="display: none">
      <span class="preloader-interior"></span>
    </div>

  @endsection

  @section('custom_js')



  <script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'></script>
  <script src='{{asset('assets/fullcalendar/packages/interaction/main.js')}}'></script>
  <script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'></script>
  <script src='{{asset('assets/fullcalendar/packages/timegrid/main.js')}}'></script>
  <script src='{{asset('assets/fullcalendar/packages/list/main.js')}}'></script>

  <script src='{{asset('assets/fullcalendar/packages-premium/resource-common/main.js')}}'></script>
  <script src='{{asset('assets/fullcalendar/packages-premium/resource-daygrid/main.js')}}'></script>
  <script src='{{asset('assets/fullcalendar/packages-premium/resource-timegrid/main.js')}}'></script>

  <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

  {{-- <script src='{{asset('js/jquery-ui.min.js')}}'></script> --}}

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <style>
  #external-events {
      float: left;
      width: 180px;
      padding: 0 5px;
      border: 1px solid #ccc;
      background: #eee;
      text-align: left;
  }
  </style>

  <script>

  // //inicializa teoricos
  // @foreach ($array as $key => $contract)
  //   @foreach ($contract as $key2 => $medical_programming)
  //
  //     // ciclo para obtener totales por profesional segun eventos guardados en bd
  //     var cont_eventos_bd = 0;
  //     @foreach ($theoreticalProgrammings as $key => $theoricalProgramming)
  //       @if($medical_programming->activity_id == $theoricalProgramming->activity_id)
  //         cont_eventos_bd+= {{$theoricalProgramming->duration_theorical_programming}};
  //       @endif
  //     @endforeach
  //
  //     var bolsa_{{$medical_programming->activity_id}} = {{$medical_programming->assigned_hour}} - cont_eventos_bd;
  //   @endforeach
  // @endforeach

  var disponible_contrato = 0;
  @foreach ($activities as $key => $activity)
      // ciclo para obtener totales por profesional segun eventos guardados en bd
      var cont_eventos_bd = 0;
      @foreach ($theoreticalProgrammings as $key => $theoricalProgramming)
        @if($activity->id == $theoricalProgramming->activity_id)
          cont_eventos_bd+= {{$theoricalProgramming->duration_theorical_programming}};
        @endif
      @endforeach
      var bolsa_{{$activity->id}} = cont_eventos_bd;
  @endforeach


  //inicializa dias ADMINISTRATIVOS
  @foreach ($permisos_administrativos as $key => $permiso_administrativo)
      // ciclo para obtener totales por profesional segun eventos guardados en bd
      var cont_eventos_bd = 0;
      @foreach ($contract_days as $key2 => $contract_day)
          @if($contract_day->contract_day_type == $key)
            cont_eventos_bd+= {{$contract_day->duration}};
          @endif
      @endforeach

      var bolsa_{{$key}} = {{$permiso_administrativo}} - cont_eventos_bd;
  @endforeach

  $(document).ready(function(){

    // //asigna teoricos
    // @foreach ($array as $key => $contract)
    //   @foreach ($contract as $key2 => $medical_programming)
    //     document.getElementById("{{$medical_programming->activity_id}}").innerHTML = bolsa_{{$medical_programming->activity_id}};
    //   @endforeach
    // @endforeach

    @foreach ($activities as $key => $activity)
        document.getElementById("{{$activity->id}}").innerHTML = bolsa_{{$activity->id}};
        disponible_contrato += bolsa_{{$activity->id}};
    @endforeach
    document.getElementById("disponible_contrato").innerHTML = disponible_contrato;

    //asigna dias administrativos
    @foreach ($permisos_administrativos as $key => $permiso_administrativo)
        document.getElementById("{{$key}}").innerHTML = bolsa_{{$key}};//{{$permiso_administrativo}};
    @endforeach

  });

  // ############## inicialización de calendario

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var Draggable = FullCalendarInteraction.Draggable

    var containerEl = document.getElementById('external-events-list');
    new Draggable(containerEl, {
      itemSelector: '.fc-event'
    });

    var diff_ = 0;
    var inicio_start;
    var termino_start;
    var calendar = new FullCalendar.Calendar(calendarEl, {
      schedulerLicenseKey: '0404885988-fcs-1582214203',
      plugins: [ 'interaction', 'resourceDayGrid', 'resourceTimeGrid', 'list' ],
      defaultView: 'timeGridWeek',
      editable: true,
      selectable: true,
      eventLimit: true, // allow "more" link when too many events
      displayEventEnd: true,
      allDaySlot: false,
      firstDay: 1,
      defaultDate: '{{$date}}',
      locale: 'es', // the initial locale
      navLinks: true,
      eventTextColor: 'white',
      header: {
        left: '',//prev,next today
        center: 'title',
        right: 'timeGridWeek'//'resourceTimeGridDay,resourceTimeGridTwoDay,timeGridWeek,dayGridMonth'
      },
      titleFormat: { // will produce something like "Tuesday, September 18, 2018"
            month: 'long',
            year: 'numeric',
            day: 'numeric',
            weekday: 'long'
        },
      timeZone: 'local',

      events: [
          @foreach ($theoreticalProgrammings as $key => $theoricalProgramming)
            //teóricos
              @if($theoricalProgramming->activity)
                  { id: '{{$theoricalProgramming->activity_id}}', title: '{{$theoricalProgramming->activity->activity_name}}',
                    start: '{{$theoricalProgramming->start_date}}', end: '{{$theoricalProgramming->end_date}}',
                    description: 'teorico'
                  },
              @endif
            //administrativos
              @if($theoricalProgramming->activity_id == null)
              { id: '{{$theoricalProgramming->activity_id}}', title: '{{$theoricalProgramming->contract_day_type}}',
                start: '{{$theoricalProgramming->start_date}}', end: '{{$theoricalProgramming->end_date}}',
                description: '{{$theoricalProgramming->contract_day_type}}', color: '#A6C6F1'
              },
              @endif

          @endforeach
      ],

      navLinkDayClick: function(date, jsEvent) {
        console.log('day', date.toISOString());
        console.log('coords', jsEvent.pageX, jsEvent.pageY);
      },

      // select: function(arg) {
      //   console.log(
      //     'select',
      //     arg.startStr,
      //     arg.endStr,
      //     arg.resource ? arg.resource.id : '(no resource)'
      //   );
      // },

      // dateClick: function(arg) {
      //   console.log(
      //     'dateClick',
      //     arg.date,
      //     arg.resource ? arg.resource.id : '(no resource)'
      //   );
      // },

      // eventRender: function (info, element) {
      //   console.log(info.el);
      //   //info.el.find(".fc-event").append("<span class='close' data-id='" + info.event.id +"'>x</span>");
      // },

      // eventRender: function(info) {
      //   var e = info.el.prepend("<span class='close' data-id='" + info.event.id +"'>x</span>");
      //   // alert(e);
      //     // var e = element.prepend("<span class='closeon'>&#10005;</span>");
      //
      //     // e.children('.closeon')
      //     //    .attr('data-event-id', event._id)
      //     //    .click( function() {
      //     //       var id = $(this).attr('data-event-id');
      //     //       $('#calendar').fullCalendar('removeEvents',id);
      //     //    });
      // },

      // Recepción de eventos
      // eventReceive: function(info) {
      //   console.log(calendar.component);
      //   var fecha_inicio = info.event.start;
      //   info.event.setEnd(add_minutes(fecha_inicio,60));
      //
      //   @foreach ($array as $key => $specialty)
      //     cont = 0;
      //     @foreach ($specialty as $key2 => $doc)
      //       if(info.event.id == "{{$doc->rut}}"){
      //         document.getElementById("{{$doc->rut}}").innerHTML = (bolsa_{{$doc->rut}} - 1);
      //         bolsa_{{$doc->rut}} = bolsa_{{$doc->rut}} - 1;
      //       }
      //       cont += bolsa_{{$doc->rut}};
      //     @endforeach
      //     document.getElementById("total_disponibles_{{$key}}").innerHTML = cont;
      //   @endforeach
      //
      //
      //   // Elimina eventos background
      //   var events = calendar.getEvents();
      //   events.forEach(function(element){
      //     if(element.id == 99999 || element.id == 99998){
      //        element.remove();
      //     }
      //   });
      //
      //   console.log(info.event);
      //   saveMyTeorico(info.event);
      // },

      // Recepción de eventos
      eventReceive: function(info) {
        var fecha_inicio = info.event.start;
        var tipo_evento = info.event.extendedProps.description;

        //tipo de evento teorico
        if (tipo_evento == 'teorico') {
            //se verifica que no exceda el máximo
            // if (window["bolsa_" + info.event.id] != '0') {
                //se setea evento de 60 mins
                info.event.setEnd(add_minutes(fecha_inicio,60));
                if (confirm('¿Desea insertar solo en esta semana?')) {
                    saveMyData(info.event, 1, tipo_evento);
                } else {
                    saveMyData(info.event, 2, tipo_evento);
                }

                // //actualiza bolsas de teoricos
                // @foreach ($array as $key => $contract)
                //   cont = 0;
                //   @foreach ($contract as $key2 => $medical_programming)
                //     if(info.event.id == "{{$medical_programming->activity_id}}"){
                //       // if((bolsa_{{$medical_programming->activity_id}} - 1) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
                //       document.getElementById("{{$medical_programming->activity_id}}").innerHTML = (bolsa_{{$medical_programming->activity_id}} - 1);
                //       bolsa_{{$medical_programming->activity_id}} = bolsa_{{$medical_programming->activity_id}} - 1;
                //     }
                //   @endforeach
                // @endforeach

                @foreach ($activities as $key => $activity)
                    if(info.event.id == "{{$activity->id}}"){
                      document.getElementById("{{$activity->id}}").innerHTML = (bolsa_{{$activity->id}} + 1);
                      bolsa_{{$activity->id}} = bolsa_{{$activity->id}} + 1;

                      disponible_contrato = disponible_contrato + 1;
                      document.getElementById("disponible_contrato").innerHTML = disponible_contrato;
                    }
                @endforeach
            // }
            // else{
            //     alert("Excedió horas semanales contratas.");
            //     info.event.remove();
            //     return;
            // }
        }
        //tipo de evento administrativo
        else{
            var cont = 0;
            console.log(window["bolsa_" + tipo_evento]);
            //se verifica que no exceda el máximo
            if (window["bolsa_" + tipo_evento] != '0') {

                $('#dialog').dialog({
                    'title': 'Alerta del sistema',
                    'buttons': {
                        'Mañana': function(event) {
                            $(event.target).css({opacity: 0.25}).unbind();
                            //se setea evento de todo el dia
                            info.event.setStart(formatDate2(fecha_inicio) + ' 00:00');
                            info.event.setEnd(formatDate2(fecha_inicio) + ' 12:59:59');
                            cont = 0.5;
                            saveMyData(info.event, 0, tipo_evento);

                            //actualiza bolsas de administrativos
                            @foreach ($permisos_administrativos as $key => $permiso_administrativo)
                                if(tipo_evento == "{{$key}}"){
                                  document.getElementById("{{$key}}").innerHTML = (bolsa_{{$key}} - cont);
                                  bolsa_{{$key}} = bolsa_{{$key}} - cont;
                                }
                            @endforeach
                            $(this).dialog("close");
                        },
                        'Tarde': function(event) {
                            $(event.target).css({opacity: 0.25}).unbind();
                            //se setea evento de todo el dia
                            info.event.setStart(formatDate2(fecha_inicio) + ' 13:00:00');
                            info.event.setEnd(formatDate2(fecha_inicio) + ' 23:59:59');
                            cont = 0.5;
                            saveMyData(info.event, 0, tipo_evento);

                            //actualiza bolsas de administrativos
                            @foreach ($permisos_administrativos as $key => $permiso_administrativo)
                                if(tipo_evento == "{{$key}}"){
                                  document.getElementById("{{$key}}").innerHTML = (bolsa_{{$key}} - cont);
                                  bolsa_{{$key}} = bolsa_{{$key}} - cont;
                                }
                            @endforeach
                            $(this).dialog("close");
                        },
                        'Todo el día': function(event) {
                            $(event.target).css({opacity: 0.25}).unbind();
                            //se setea evento de todo el dia
                            info.event.setStart(formatDate2(fecha_inicio) + ' 00:00');
                            info.event.setEnd(formatDate2(fecha_inicio) + ' 23:59:59');
                            cont = 1;
                            saveMyData(info.event, 0, tipo_evento);

                            //actualiza bolsas de administrativos
                            @foreach ($permisos_administrativos as $key => $permiso_administrativo)
                                if(tipo_evento == "{{$key}}"){
                                  document.getElementById("{{$key}}").innerHTML = (bolsa_{{$key}} - cont);
                                  bolsa_{{$key}} = bolsa_{{$key}} - cont;
                                }
                            @endforeach
                            $(this).dialog("close");
                        }
                    }
                });

            }
            else{
                alert("No dispone de días administrativos.");
                info.event.remove();
                return;
            }
        }
      },

      //######### desplazamiento de eventos

      eventDragStart: function(info) {
        console.log(info);
        // deleteMyDataForce(info.event);
        inicio_start = info.event.start;
        termino_start = info.event.end;
        console.log(info.event);
      },

      eventDrop: function(info) {
        // console.log(info.jsEvent.clientX);
        // saveMyData(info.event);
        var tipo_evento = info.event.extendedProps.description;

        //tipo de evento teorico
        if (tipo_evento == 'teorico') {
            if (confirm('¿Desea modificar solo este evento?')) {
                updateMyData(info.event, 1);
            } else {
                updateMyData(info.event, 2);
            }
        }
        //tipo de evento administrativo
        else{
            //se setea evento de todo el dia
            var fecha_inicio = info.event.start;
            info.event.setStart(formatDate2(fecha_inicio) + ' ' + formatHour(inicio_start));
            info.event.setEnd(formatDate2(fecha_inicio) + ' ' + formatHour(termino_start));
            // updateMyData(info.event, 1);
        }
      },

      eventDragStop: function(info) {
          if(isEventOverDiv(info.jsEvent.clientX, info.jsEvent.clientY)) {
              var inicio = info.event.start;
              var termino = info.event.end;
              var diff =(termino.getTime() - inicio.getTime()) / 1000;
              diff /= 60;
              diff_ = diff/60;
              //alert(diff_);
              //console.log(info.event);

              var tipo_evento = info.event.extendedProps.description;

              //tipo de evento teorico
              if (tipo_evento == 'teorico') {
                  info.event.remove();
                  deleteMyData(info.event, 1);

                  // @foreach ($array as $key => $contract)
                  //   @foreach ($contract as $key2 => $medical_programming)
                  //     if(info.event.id == "{{$medical_programming->activity_id}}"){
                  //       document.getElementById("{{$medical_programming->activity_id}}").innerHTML = (bolsa_{{$medical_programming->activity_id}} + diff_);
                  //       bolsa_{{$medical_programming->activity_id}} = bolsa_{{$medical_programming->activity_id}} + diff_;
                  //     }
                  //   @endforeach
                  // @endforeach

                  @foreach ($activities as $key => $activity)
                      if(info.event.id == "{{$activity->id}}"){
                        document.getElementById("{{$activity->id}}").innerHTML = (bolsa_{{$activity->id}} - diff_);
                        bolsa_{{$activity->id}} = bolsa_{{$activity->id}} - diff_;

                        disponible_contrato = disponible_contrato - diff_;
                        document.getElementById("disponible_contrato").innerHTML = disponible_contrato;
                      }
                  @endforeach
              }
              //tipo de evento administrativo
              else{
                  info.event.remove();
                  deleteMyData(info.event, 1);

                  //se verifica si se debe restar 0.5 hrs o 1 dia entero.
                  var cont = 1;
                  if (formatHour(termino_start) == '12:59' || formatHour(inicio_start) == '13:00') {
                      cont = 0.5;
                  }

                  //actualiza bolsas de administrativos
                  @foreach ($permisos_administrativos as $key => $permiso_administrativo)
                      if(tipo_evento == "{{$key}}"){
                        document.getElementById("{{$key}}").innerHTML = (bolsa_{{$key}} + cont);
                        bolsa_{{$key}} = bolsa_{{$key}} + cont;
                      }
                  @endforeach
              }
          }
      },

      eventClick: function(info) {
        info.jsEvent.preventDefault(); // don't let the browser navigate

        console.log(info.event);
        // if (info.event.id) {
            var event = calendar.getEventById(info.event.id);

            if(confirm("¿Desea eliminar la hora?")){
                var inicio = info.event.start;
                var termino = info.event.end;
                var diff =(termino.getTime() - inicio.getTime()) / 1000;
                diff /= 60;
                diff_ = diff/60;
                //alert(diff_);
                //console.log(info.event);

                var tipo_evento = info.event.extendedProps.description;

                //tipo de evento teorico
                if (tipo_evento == 'teorico') {
                    if (confirm('¿Desea eliminar solo este evento?')) {
                        info.event.remove();
                        deleteMyData(info.event, 1);
                    } else {
                        info.event.remove();
                        deleteMyData(info.event, 2);
                    }

                    // @foreach ($array as $key => $contract)
                    //   @foreach ($contract as $key2 => $medical_programming)
                    //     if(info.event.id == "{{$medical_programming->activity_id}}"){
                    //       document.getElementById("{{$medical_programming->activity_id}}").innerHTML = (bolsa_{{$medical_programming->activity_id}} + diff_);
                    //       bolsa_{{$medical_programming->activity_id}} = bolsa_{{$medical_programming->activity_id}} + diff_;
                    //     }
                    //   @endforeach
                    // @endforeach

                    @foreach ($activities as $key => $activity)
                        if(info.event.id == "{{$activity->id}}"){
                            document.getElementById("{{$activity->id}}").innerHTML = (bolsa_{{$activity->id}} - diff_);
                            bolsa_{{$activity->id}} = bolsa_{{$activity->id}} - diff_;

                            disponible_contrato = disponible_contrato - diff_;
                            document.getElementById("disponible_contrato").innerHTML = disponible_contrato;
                        }
                    @endforeach
                }
                //tipo de evento administrativo
                else{
                    info.event.remove();
                    deleteMyData(info.event, 1);

                    //se verifica si se debe restar 0.5 hrs o 1 dia entero.
                    var cont = 1;
                    if (formatHour(termino) == '12:59' || formatHour(inicio) == '13:00') {
                        cont = 0.5;
                    }

                    //actualiza bolsas de administrativos
                    @foreach ($permisos_administrativos as $key => $permiso_administrativo)
                        if(tipo_evento == "{{$key}}"){
                          document.getElementById("{{$key}}").innerHTML = (bolsa_{{$key}} + cont);
                          bolsa_{{$key}} = bolsa_{{$key}} + cont;
                        }
                    @endforeach
                }
            }
        // }
      },

      //######## redimención de eventos
      eventResizeStart: function(info){
        var inicio = info.event.start;
        var termino = info.event.end;
        var diff =(termino.getTime() - inicio.getTime()) / 1000;
        diff /= 60;
        diff_ = diff/60;
        inicio_start = info.event.start;
        termino_start = info.event.end;

        console.log(info.event);
        // deleteMyDataForce(info.event);
      },

      eventResize: function(info) {
        var inicio = info.event.start;
        var termino = info.event.end;
        var diff =(termino.getTime() - inicio.getTime()) / 1000;
        diff /= 60;
        diff = (diff/60) - diff_;

        var tipo_evento = info.event.extendedProps.description;
        // alert(tipo_evento);
        //solo se permite modificar el tamaño a los eventos teoricos
        if (tipo_evento == 'teorico') {

            // @foreach ($array as $key => $contract)
            //   @foreach ($contract as $key2 => $medical_programming)
            //     if(info.event.id == "{{$medical_programming->activity_id}}"){
            //       if((bolsa_{{$medical_programming->activity_id}} - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
            //       document.getElementById("{{$medical_programming->activity_id}}").innerHTML = (bolsa_{{$medical_programming->activity_id}} - diff);
            //       bolsa_{{$medical_programming->activity_id}} = bolsa_{{$medical_programming->activity_id}} - diff;
            //     }
            //   @endforeach
            // @endforeach

            @foreach ($activities as $key => $activity)
                if(info.event.id == "{{$activity->id}}"){
                    // if((bolsa_{{$activity->id}} - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
                    document.getElementById("{{$activity->id}}").innerHTML = (bolsa_{{$activity->id}} + diff);
                    bolsa_{{$activity->id}} = bolsa_{{$activity->id}} + diff;

                    disponible_contrato = disponible_contrato + diff;
                    document.getElementById("disponible_contrato").innerHTML = disponible_contrato;
                }
            @endforeach

            console.log(info.event);
            if (confirm('¿Desea modificar solo este evento?')) {
                updateMyData(info.event, 1);
            }else{
                updateMyData(info.event, 1);
            }

        }else{
            alert("No se puede modificar un evento de día administrativo.");info.revert();return;
        }
      }
    });

    //tipo de ingreso: Evento actual - Resto del año
    //tipo de evento: 1-Teórco , 2-Administrativo
    function saveMyData(event, tipo_ingreso, tipo_evento) {
      let start_date = formatDateWithHour(event.start);
      let end_date = formatDateWithHour(event.end);

      let activity_id = event.id.toString();
      var rut = {{$request->rut}};
      var year = {{$request->year}};
      var contract_id = $("#for_contract_id"). val();
      var specialty_id = $("#for_specialty_id"). val();

      $.ajax({
          url: "{{ route('ehr.hetg.theoretical_programming.saveMyEvent') }}",
          type: 'post',
          data:{rut:rut,activity_id:activity_id,contract_id:contract_id,specialty_id:specialty_id, start_date:start_date, end_date:end_date, year:year, tipo_ingreso:tipo_ingreso, tipo_evento:tipo_evento},
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
      });
    }

    // function saveMyAdministrativo(event) {
    //   let start_date = formatDateWithHour(event.start);
    //   let end_date = formatDateWithHour(event.end);
    //
    //   // let activity_id = event.id.toString();
    //   var rut = {{$request->rut}};
    //   var year = {{$request->year}};
    //
    //   $.ajax({
    //       url: "{{ route('ehr.hetg.theoretical_programming.saveMyEvent') }}",
    //       type: 'post',
    //       data:{rut:rut,start_date:start_date, end_date:end_date, year:year},
    //       headers: {
    //           'X-CSRF-TOKEN': "{{ csrf_token() }}"
    //       },
    //   });
    // }

    function updateMyData(event, tipo) {
      let start_date = formatDateWithHour(event.start);
      let start_date_start = formatDateWithHour(inicio_start);

      let end_date = formatDateWithHour(event.end);
      let end_date_start = formatDateWithHour(termino_start);

      // console.log(start_date_start + " " + end_date_start);
      let activity_id = event.id.toString();
      var rut = {{$request->rut}};
      var year = {{$request->year}};
      var contract_id = $("#for_contract_id"). val();
      var specialty_id = $("#for_specialty_id"). val();

      $.ajax({
          url: "{{ route('ehr.hetg.theoretical_programming.updateMyEvent') }}",
          type: 'post',
          data:{rut:rut,activity_id:activity_id,contract_id:contract_id,specialty_id:specialty_id,start_date_start:start_date_start, start_date:start_date,end_date_start:end_date_start, end_date:end_date, year:year, tipo:tipo},
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
      });
    }

    function deleteMyData(event, tipo) {
        let start_date = formatDateWithHour(event.start);
        let end_date = formatDateWithHour(event.end);

        let activity_id = event.id.toString();
        var rut = {{$request->rut}};
        var year = {{$request->year}};
        var contract_id = $("#for_contract_id"). val();
        var specialty_id = $("#for_specialty_id"). val();

      $.ajax({
          url: "{{ route('ehr.hetg.theoretical_programming.deleteMyEvent') }}",
          type: 'post',
          data:{rut:rut,activity_id:activity_id,contract_id:contract_id,specialty_id:specialty_id,start_date:start_date, end_date:end_date, year:year, tipo:tipo},
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
      });
    }

    function deleteMyDataForce(event, tipo) {
        let start_date = formatDateWithHour(event.start);
        let end_date = formatDateWithHour(event.end);

        let activity_id = event.id.toString();
        var rut = {{$request->rut}};
        var year = {{$request->year}};
        var contract_id = $("#for_contract_id"). val();
        var specialty_id = $("#for_specialty_id"). val();

      $.ajax({
          url: "{{ route('ehr.hetg.theoretical_programming.deleteMyEventForce') }}",
          type: 'post',
          data:{rut:rut,activity_id:activity_id,contract_id:contract_id,specialty_id:specialty_id,start_date:start_date, end_date:end_date, year:year, tipo:tipo},
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
      });
    }

    var isEventOverDiv = function(x, y) {
        var external_events = $( '#external-events' );
        var offset = external_events.offset();
        offset.right = external_events.width() + offset.left;
        offset.bottom = external_events.height() + offset.top;

        // Compare
        if (x >= offset.left
            && y >= offset.top
            && x <= offset.right
            && y <= offset .bottom) { return true; }
        return false;
    }

    var add_minutes =  function (dt, minutes) {
        return new Date(dt.getTime() + minutes*60000);
    }

    calendar.setOption('locale', 'es');
    calendar.render();

    //obtenemos semana traida desde bd (con esa info para comparación)
    $('#prev').click(function(e) {
        calendar.prev();
        //console.log(calendar.state.currentDate);

        var calendar_date = formatDate(calendar.state.currentDate);
        var bdweek = {{Carbon\Carbon::parse($date)->format("W")}};
        var calendarweek = semanaISO(calendar_date);

        if (bdweek != calendarweek) {
          // alert("Se ha actualizado la información de la semana.");
          $('#page-loader').fadeIn(500);
          $('#date').val(formatDate2MasUnDia(calendar.state.currentDate));
          $( "#form" ).submit();

        }

    });
    $('#next').click(function(e) {
        calendar.next();
        //console.log(calendar.state.currentDate);

        var calendar_date = formatDate(calendar.state.currentDate);
        var bdweek = {{Carbon\Carbon::parse($date)->format("W")}};
        var calendarweek = semanaISO(calendar_date);

        if (bdweek != calendarweek) {
          // alert("Se ha actualizado la información de la semana.");
          $('#page-loader').fadeIn(500);
          $('#date').val(formatDate2MasUnDia(calendar.state.currentDate));
          $( "#form" ).submit();

        }
    });

    //obtiene fecha formateada (se le suma 1 al día para que calce con calendario)
    //formato fecha dd-mm-YYYY
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + (d.getDate() + 1),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;
        return [day, month, year].join('-');
    }

    function formatDateWithHour(date) {
        var dateStr =
              ("00" + (date.getMonth() + 1)).slice(-2) + "/" +
              ("00" + date.getDate()).slice(-2) + "/" +
              date.getFullYear() + " " +
              ("00" + date.getHours()).slice(-2) + ":" +
              ("00" + date.getMinutes()).slice(-2);
        return dateStr;
    }

    function formatHour(date) {
        var dateStr =
              ("00" + date.getHours()).slice(-2) + ":" +
              ("00" + date.getMinutes()).slice(-2);
        return dateStr;
    }

    //formatea la fecha YYYY-mm--dd
    function formatDate2(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + (d.getDate()),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;
        return [year, month, day].join('-');
    }

    //formatea la fecha YYYY-mm--dd (le suma un día)
    function formatDate2MasUnDia(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + (d.getDate() + 1),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;
        return [year, month, day].join('-');
    }

    //obtiene numero de la semana del año
    function semanaISO($fecha){
       if($fecha.match(/\//)){
          $fecha   =   $fecha.replace(/\//g,"-",$fecha); //Permite que se puedan ingresar formatos de fecha ustilizando el "/" o "-" como separador
       };

       $fecha   =   $fecha.split("-"); //Dividimos el string de fecha en trozos (dia,mes,año)
       $dia   =   eval($fecha[0]);
       $mes   =   eval($fecha[1]);
       $ano   =   eval($fecha[2]);

       if ($mes==1 || $mes==2){
          //Cálculos si el mes es Enero o Febrero
          $a   =   $ano-1;
          $b   =   Math.floor($a/4)-Math.floor($a/100)+Math.floor($a/400);
          $c   =   Math.floor(($a-1)/4)-Math.floor(($a-1)/100)+Math.floor(($a-1)/400);
          $s   =   $b-$c;
          $e   =   0;
          $f   =   $dia-1+(31*($mes-1));
       } else {
          //Calculos para los meses entre marzo y Diciembre
          $a   =   $ano;
          $b   =   Math.floor($a/4)-Math.floor($a/100)+Math.floor($a/400);
          $c   =   Math.floor(($a-1)/4)-Math.floor(($a-1)/100)+Math.floor(($a-1)/400);
          $s   =   $b-$c;
          $e   =   $s+1;
          $f   =   $dia+Math.floor(((153*($mes-3))+2)/5)+58+$s;
       };

       //Adicionalmente sumándole 1 a la variable $f se obtiene numero ordinal del dia de la fecha ingresada con referencia al año actual.

       //Estos cálculos se aplican a cualquier mes
       $g   =   ($a+$b)%7;
       $d   =   ($f+$g-$e)%7; //Adicionalmente esta variable nos indica el dia de la semana 0=Lunes, ... , 6=Domingo.
       $n   =   $f+3-$d;

       if ($n<0){
          //Si la variable n es menor a 0 se trata de una semana perteneciente al año anterior
          $semana   =   53-Math.floor(($g-$s)/5);
          $ano      =   $ano-1;
       } else if ($n>(364+$s)) {
          //Si n es mayor a 364 + $s entonces la fecha corresponde a la primera semana del año siguiente.
          $semana   = 1;
          $ano   =   $ano+1;
       } else {
          //En cualquier otro caso es una semana del año actual.
          $semana   =   Math.floor($n/7)+1;
       };

       return $semana; //+"-"+$ano; //La función retorna una cadena de texto indicando la semana y el año correspondiente a la fecha ingresada
    };

  });

  //obtiene cantidad de horas del contrato seleccionado
  $( "#for_contract_id" ).change(function() {
    @foreach($contracts as $contract)
      if($("#for_contract_id").val() == {{$contract->id}}){
        $("#total_contrato").text({{$contract->weekly_hours}});
      }
    @endforeach
  });

  </script>

  @endsection

  @section('custom_js_head')
    <link href='{{asset('assets/fullcalendar/packages/core/main.css')}}' rel='stylesheet' />
    <link href='{{asset('assets/fullcalendar/packages/daygrid/main.css')}}' rel='stylesheet' />
    <link href='{{asset('assets/fullcalendar/packages/timegrid/main.css')}}' rel='stylesheet' />
    <link href='{{asset('assets/fullcalendar/packages/list/main.css')}}' rel='stylesheet' />
    <link href='{{asset('assets/fullcalendar/css/style.css')}}' rel='stylesheet' />
    {{-- <link href='{{asset('css/jquery-ui.min.css')}}' rel='stylesheet' /> --}}
  @endsection
