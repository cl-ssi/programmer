@extends('layouts.app')

@section('title', 'Formulario de requerimiento')

@section('content')

    {{ Auth::user()->name }}

<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>

<h3 class="mb-3">Programación Teórico de Profesionales.</h3>

<form method="GET" id="form" class="form-horizontal" action="{{ route('ehr.hetg.theoretical_programming.index') }}">
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

  </div>
</form>


{{-- <hr> --}}

  <!-- <h5 class="mb-5">Programación de Traumatología.</h5> -->

  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Calendario</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Días Contrato</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

        <br />
        <div id='wrap'>

          <div id='external-events'>

            <div id='external-events-list'>

              @foreach ($array as $key => $contract)
                <small>{{str_replace('_', ' ', $key)}}</small>
                @foreach ($contract as $key2 => $unscheduled_programming)
                  <div class='fc-event' data-event='{"title":"{{$unscheduled_programming->activity->activity_name}}",
                                                     "id":"{{$unscheduled_programming->activity_id}}", "description":"1"}'>
                      <small>{{$unscheduled_programming->activity->activity_name}}: <span id="{{$unscheduled_programming->activity_id}}"></span></small>
                  </div>
                @endforeach
              @endforeach
            </div>

            <br />
            <br />

          </div>

          <div id='calendar'></div>

          <div style='clear:both'></div>

        </div>

    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @include('ehr/hetg/management/contract_days')
    </div>
  </div>


  @endsection

  @section('custom_js')

    <link href='{{asset('assets/fullcalendar/packages/core/main.css')}}' rel='stylesheet' />
    <link href='{{asset('assets/fullcalendar/packages/daygrid/main.css')}}' rel='stylesheet' />
    <link href='{{asset('assets/fullcalendar/packages/timegrid/main.css')}}' rel='stylesheet' />
    <link href='{{asset('assets/fullcalendar/packages/list/main.css')}}' rel='stylesheet' />

    <link href='{{asset('assets/fullcalendar/css/style.css')}}' rel='stylesheet' />

    <script src='{{asset('assets/fullcalendar/packages/core/main.js')}}'></script>
    <script src='{{asset('assets/fullcalendar/packages/interaction/main.js')}}'></script>
    <script src='{{asset('assets/fullcalendar/packages/daygrid/main.js')}}'></script>
    <script src='{{asset('assets/fullcalendar/packages/timegrid/main.js')}}'></script>
    <script src='{{asset('assets/fullcalendar/packages-premium/resource-common/main.js')}}'></script>
    <script src='{{asset('assets/fullcalendar/packages-premium/resource-daygrid/main.js')}}'></script>
    <script src='{{asset('assets/fullcalendar/packages-premium/resource-timegrid/main.js')}}'></script>

    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

    {{-- <script src='{{asset('assets/fullcalendar/js/calendar.js')}}'></script> --}}
    <style>
    #external-events {
        float: left;
        width: 190px;
        padding: 0 5px;
        border: 1px solid #ccc;
        background: #eee;
        text-align: left;
    }
    </style>

  <script>

  // var bolsa_111 = 6;
  // var bolsa_222 = 4;
  // var bolsa_333 = 4;
  // var bolsa_444 = 2;
  // var bolsa_555 = 8;
  // var bolsa_666 = 8;
  // var bolsa_777 = 8;
  // var bolsa_888 = 8;
  // var bolsa_999 = 8;

  @foreach ($array as $key => $contract)
    @foreach ($contract as $key2 => $unscheduled_programming)

      // ciclo para obtener totales por profesional segun eventos guardados en bd
      var cont_eventos_bd = 0;
      @foreach ($theoricalProgrammings as $key => $theoricalProgramming)
        @if($unscheduled_programming->activity_id == $theoricalProgramming->activity_id)
          cont_eventos_bd+= {{$theoricalProgramming->duration_theorical_programming}};
        @endif
      @endforeach

      var bolsa_{{$unscheduled_programming->activity_id}} = {{$unscheduled_programming->assigned_hour}} - cont_eventos_bd;
    @endforeach
  @endforeach

  $(document).ready(function(){
    // document.getElementById("111").innerHTML = bolsa_111;
    // document.getElementById("222").innerHTML = bolsa_222;
    // document.getElementById("333").innerHTML = bolsa_333;
    // document.getElementById("total_traumatologia").innerHTML = bolsa_111 + bolsa_222 + bolsa_333;
    //
    // document.getElementById("444").innerHTML = bolsa_444;
    // document.getElementById("555").innerHTML = bolsa_555;
    // document.getElementById("total_oftalmologia").innerHTML = bolsa_444 + bolsa_555;
    //
    // document.getElementById("666").innerHTML = bolsa_666;
    // document.getElementById("777").innerHTML = bolsa_777;
    // document.getElementById("888").innerHTML = bolsa_888;
    // document.getElementById("999").innerHTML = bolsa_999;
    // document.getElementById("total_cirugia").innerHTML = bolsa_666 + bolsa_777 + bolsa_888 + bolsa_999;

    @foreach ($array as $key => $contract)
      @foreach ($contract as $key2 => $unscheduled_programming)
        document.getElementById("{{$unscheduled_programming->activity_id}}").innerHTML = bolsa_{{$unscheduled_programming->activity_id}};
      @endforeach
    @endforeach

  });


  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var Draggable = FullCalendarInteraction.Draggable

    var containerEl = document.getElementById('external-events-list');
    new Draggable(containerEl, {
      itemSelector: '.fc-event'
    });

    var diff_ = 0;
    var calendar = new FullCalendar.Calendar(calendarEl, {
      columnHeaderHtml: function(date) {
        if (date.getUTCDay() === 1) {
          return '<b>Lunes</b>';
        }
        if (date.getUTCDay() === 2) {
          return '<b>Martes</b>';
        }
        if (date.getUTCDay() === 3) {
          return '<b>Miércoles</b>';
        }
        if (date.getUTCDay() === 4) {
          return '<b>Jueves</b>';
        }
        if (date.getUTCDay() === 5) {
          return '<b>Viernes</b>';
        }
        if (date.getUTCDay() === 6) {
          return '<b>Sábado</b>';
        }
        if (date.getUTCDay() === 0) {
          return '<b>Domingo</b>';
        }
      },

      schedulerLicenseKey: '0404885988-fcs-1582214203',
      plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ], //'dayGrid', 'timeGrid', 'list', 'interaction'
      defaultView: 'timeGridWeek',
      editable: true,
      selectable: true,
      eventLimit: true, // allow "more" link when too many events
      displayEventEnd: true,
      allDaySlot: false,
      firstDay: 1,
      defaultDate: '1900-01-01', //fecha por defecto. Solo sirve para obtener hora.
      header: {
        left: '',
        center: '',
        right: 'timeGridWeek'
      },
      locale: 'es', // the initial locale


      events: [
        @foreach ($theoricalProgrammings as $key => $theoricalProgramming)
            { id: '{{$theoricalProgramming->activity_id}}', title: '{{$theoricalProgramming->activity->activity_name}}',
              start: '{{$theoricalProgramming->start_date}}', end: '{{$theoricalProgramming->end_date}}',
              description: '1'
            },
        @endforeach
      ],


      // Recepción de eventos
      eventReceive: function(info) {
        var fecha_inicio = info.event.start;
        info.event.setEnd(add_minutes(fecha_inicio,60));

        @foreach ($array as $key => $contract)
          cont = 0;
          @foreach ($contract as $key2 => $unscheduled_programming)
            if(info.event.id == "{{$unscheduled_programming->activity_id}}"){
              // if((bolsa_{{$unscheduled_programming->activity_id}} - 1) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
              document.getElementById("{{$unscheduled_programming->activity_id}}").innerHTML = (bolsa_{{$unscheduled_programming->activity_id}} - 1);
              bolsa_{{$unscheduled_programming->activity_id}} = bolsa_{{$unscheduled_programming->activity_id}} - 1;
            }
          @endforeach
        @endforeach
        // console.log(info.event);
        saveMyData(info.event);
      },

      //######### desplazamiento de eventos

      eventDragStart: function(info) {
        console.log(info.event.start);
        deleteMyDataForce(info.event);
      },

      eventDrop: function(info) {
        console.log(info.jsEvent.clientX);
        saveMyData(info.event);
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

            @foreach ($array as $key => $contract)
              @foreach ($contract as $key2 => $unscheduled_programming)
                if(info.event.id == "{{$unscheduled_programming->activity_id}}"){
                  document.getElementById("{{$unscheduled_programming->activity_id}}").innerHTML = (bolsa_{{$unscheduled_programming->activity_id}} + diff_);
                  bolsa_{{$unscheduled_programming->activity_id}} = bolsa_{{$unscheduled_programming->activity_id}} + diff_;
                }
              @endforeach
            @endforeach

            info.event.remove();
            deleteMyData(info.event);
          }
      },

      eventClick: function(info) {
        info.jsEvent.preventDefault(); // don't let the browser navigate

        if (info.event.id) {
            var event = calendar.getEventById(info.event.id);

            if(confirm("¿Desea eliminar la hora?")){
                var inicio = info.event.start;
                var termino = info.event.end;
                var diff =(termino.getTime() - inicio.getTime()) / 1000;
                diff /= 60;
                diff_ = diff/60;
                //alert(diff_);
                //console.log(info.event);

                @foreach ($array as $key => $contract)
                  @foreach ($contract as $key2 => $unscheduled_programming)
                    if(info.event.id == "{{$unscheduled_programming->activity_id}}"){
                      document.getElementById("{{$unscheduled_programming->activity_id}}").innerHTML = (bolsa_{{$unscheduled_programming->activity_id}} + diff_);
                      bolsa_{{$unscheduled_programming->activity_id}} = bolsa_{{$unscheduled_programming->activity_id}} + diff_;
                    }
                  @endforeach
                @endforeach

                info.event.remove();
                deleteMyData(info.event);
            }
        }
      },

      //######## redimención de eventos
      eventResizeStart: function(info){
        var inicio = info.event.start;
        var termino = info.event.end;
        var diff =(termino.getTime() - inicio.getTime()) / 1000;
        diff /= 60;
        diff_ = diff/60;

        console.log(info.event);
        deleteMyDataForce(info.event);
      },

      eventResize: function(info) {
        var inicio = info.event.start;
        var termino = info.event.end;
        var diff =(termino.getTime() - inicio.getTime()) / 1000;
        diff /= 60;
        diff = (diff/60) - diff_;

        @foreach ($array as $key => $contract)
          @foreach ($contract as $key2 => $unscheduled_programming)
            if(info.event.id == "{{$unscheduled_programming->activity_id}}"){
              if((bolsa_{{$unscheduled_programming->activity_id}} - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
              document.getElementById("{{$unscheduled_programming->activity_id}}").innerHTML = (bolsa_{{$unscheduled_programming->activity_id}} - diff);
              bolsa_{{$unscheduled_programming->activity_id}} = bolsa_{{$unscheduled_programming->activity_id}} - diff;
            }
          @endforeach
        @endforeach

        console.log(info.event);
        saveMyData(info.event);
      }

    });

    var add_minutes =  function (dt, minutes) {
        return new Date(dt.getTime() + minutes*60000);
    }

    function saveMyData(event) {

      let event_start = new Date(event.start);
      let start_time = event_start.toTimeString().split(' ')[0];//event_start.getHours() + ":" + event_start.getMinutes();
      let event_end = new Date(event.end);
      let end_time = event_end.toTimeString().split(' ')[0];//event_end.getHours() + ":" + event_end.getMinutes();
      // let operating_room_id = event.getResources().map(function(resource) { return resource.id }).toString();
      let activity_id = event.id.toString();
      var rut = {{$request->rut}};
      var year = {{$request->year}};
      var week_day = event_start.getDay();
      // let specialty_id = event.extendedProps.description.toString();

      $.ajax({
          url: "{{ route('ehr.hetg.theoretical_programming.saveMyEvent') }}",
          type: 'post',
          data:{rut:rut,activity_id:activity_id,week_day:week_day,start_time:start_time, end_time:end_time, year:year},
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          // success:function(){
          //     alert("succes drag");
          // },error:function(){
          //     alert("erreur drag !!!!");
          // }
      });
    }

    function deleteMyData(event) {

      let event_start = new Date(event.start);
      let start_time = event_start.toTimeString().split(' ')[0];//event_start.getHours() + ":" + event_start.getMinutes();
      let event_end = new Date(event.end);
      let end_time = event_end.toTimeString().split(' ')[0];//event_end.getHours() + ":" + event_end.getMinutes();
      // let operating_room_id = event.getResources().map(function(resource) { return resource.id }).toString();
      let activity_id = event.id.toString();
      var rut = {{$request->rut}};
      var year = {{$request->year}};
      var week_day = event_start.getDay();
      // let specialty_id = event.extendedProps.description.toString();

      $.ajax({
          url: "{{ route('ehr.hetg.theoretical_programming.deleteMyEvent') }}",
          type: 'post',
          data:{rut:rut,activity_id:activity_id,week_day:week_day,start_time:start_time, end_time:end_time, year:year},
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          // success:function(){
          //     alert("succes drag");
          // },error:function(){
          //     alert("erreur drag !!!!");
          // }
      });
    }

    function deleteMyDataForce(event) {

      let event_start = new Date(event.start);
      let start_time = event_start.toTimeString().split(' ')[0];//event_start.getHours() + ":" + event_start.getMinutes();
      let event_end = new Date(event.end);
      let end_time = event_end.toTimeString().split(' ')[0];//event_end.getHours() + ":" + event_end.getMinutes();
      // let operating_room_id = event.getResources().map(function(resource) { return resource.id }).toString();
      let activity_id = event.id.toString();
      var rut = {{$request->rut}};
      var year = {{$request->year}};
      var week_day = event_start.getDay();
      // let specialty_id = event.extendedProps.description.toString();

      $.ajax({
          url: "{{ route('ehr.hetg.theoretical_programming.deleteMyEventForce') }}",
          type: 'post',
          data:{rut:rut,activity_id:activity_id,week_day:week_day,start_time:start_time, end_time:end_time, year:year},
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          // success:function(){
          //     alert("succes drag");
          // },error:function(){
          //     alert("erreur drag !!!!");
          // }
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
  });


  </script>

  @endsection

  @section('custom_js_head')

  @endsection
