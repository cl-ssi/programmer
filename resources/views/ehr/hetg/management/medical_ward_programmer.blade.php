@extends('layouts.app')

@section('title', 'Programación de Pabellones')

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

<h3 class="mb-3">Programación de Pabellones Quirúrgicos.</h3>

<hr>

<h5 class="mb-3"></h5>

<form method="GET" id="form" class="form-horizontal" action="{{ route('ehr.hetg.operating_room_programming.index') }}">

<div align="right">
  <p>
    {{-- <button id='next'><i class="fas fa-calendar-alt fa-fw"></i></button> --}}
    <input name="date2" type="date" onchange="this.form.submit()">
    <button id='prev'>Anterior</button>
    <button id='next'>Próximo</button>
  </p>
</div>

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
        <label for="for_operating_room">Pabellón</label>
        <select name="operating_room" id="operating_room" class="form-control selectpicker" required="" onchange="this.form.submit()" data-live-search="true" data-size="5">
          <option value="0"></option>
          @foreach($operatingRooms as $operatingRoom)
            <option value="{{$operatingRoom->id}}" {{ $operatingRoom->id == $request->operating_room ? 'selected' : '' }}>{{$operatingRoom->description}}</option>
          @endforeach
        </select>
    </fieldset>

  </div>
</form>

  <div id='wrap'>

    <div id='external-events'>
      <div id='external-events-list'>

          @foreach ($specialties as $key => $specialty)
              <div class='fc-event' style="background-color: #{{$specialty->color}};" data-color='#{{$specialty->color}}'
                    data-event='{"title":"{{$specialty->specialty_name}}",
                                 "id":"{{$specialty->id}}",
                                 "description":"{{$specialty->specialty_name}}",
                                 "color":"#{{$specialty->color}}"}'>
                  <small>{{$specialty->specialty_name}}</span></small>
              </div>
          @endforeach

      </div>
    </div>


    <div id='calendar'></div>

    <div style='clear:both'></div>

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

  $(document).ready(function(){

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
      header: {
        left: '',//prev,next today
        center: 'title',
        right: 'timeGridWeek'//'resourceTimeGridDay,resourceTimeGridTwoDay,timeGridWeek,dayGridMonth'
      },
      timeZone: 'local',

      events: [
          @foreach ($operatingRoomProgrammings as $key => $operatingRoomProgramming)
            { id: '{{$operatingRoomProgramming->specialty_id}}', title: '{{$operatingRoomProgramming->specialty->specialty_name}}',
              start: '{{$operatingRoomProgramming->start_date}}', end: '{{$operatingRoomProgramming->end_date}}',
              description: 'teoricos', color:'#{{$operatingRoomProgramming->specialty->color}}'
            },
          @endforeach
      ],

      navLinkDayClick: function(date, jsEvent) {
        console.log('day', date.toISOString());
        console.log('coords', jsEvent.pageX, jsEvent.pageY);
      },

      // Recepción de eventos
      eventReceive: function(info) {
        var fecha_inicio = info.event.start;

        //se setea evento de 60 mins
        info.event.setEnd(add_minutes(fecha_inicio,60));
        if (confirm('¿Desea insertar solo en esta semana?')) {
            saveMyData(info.event, 1);
        } else {
            saveMyData(info.event, 2);
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

        if (confirm('¿Desea modificar solo este evento?')) {
            updateMyData(info.event, 1);
        } else {
            updateMyData(info.event, 2);
        }
      },

      eventDragStop: function(info) {
          if(isEventOverDiv(info.jsEvent.clientX, info.jsEvent.clientY)) {
              var inicio = info.event.start;
              var termino = info.event.end;
              var diff =(termino.getTime() - inicio.getTime()) / 1000;
              diff /= 60;
              diff_ = diff/60;

              info.event.remove();
              deleteMyData(info.event, 1);
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

                if (confirm('¿Desea eliminar solo este evento?')) {
                    info.event.remove();
                    deleteMyData(info.event, 1);
                } else {
                    info.event.remove();
                    deleteMyData(info.event, 2);
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

        if (confirm('¿Desea modificar solo este evento?')) {
            updateMyData(info.event, 1);
        } else {
            updateMyData(info.event, 2);
        }
        console.log(info.event);
      }
    });

    //tipo de ingreso: Evento actual - Resto del año
    //tipo de evento: 1-Teórco , 2-Administrativo
    function saveMyData(event, tipo_ingreso) {
      let start_date = formatDateWithHour(event.start);
      let end_date = formatDateWithHour(event.end);

      let operating_room_id = {{$request->operating_room}};
      let specialty_id = event.id.toString();
      var year = {{$request->year}};

      // alert(operating_room_id + ' ' + specialty_id+ ' ' +start_date+ ' ' + end_date+ ' ' + year+ ' ' + tipo_ingreso);

      $.ajax({
          url: "{{ route('ehr.hetg.operating_room_programming.saveMyEvent') }}",
          type: 'post',
          data:{operating_room_id:operating_room_id, specialty_id:specialty_id,start_date:start_date, end_date:end_date, year:year, tipo_ingreso:tipo_ingreso},
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
      });
    }

    function updateMyData(event, tipo) {
      let start_date = formatDateWithHour(event.start);
      let start_date_start = formatDateWithHour(inicio_start);

      let end_date = formatDateWithHour(event.end);
      let end_date_start = formatDateWithHour(termino_start);

      // console.log(start_date_start + " " + end_date_start);
      let operating_room_id = {{$request->operating_room}};
      let specialty_id = event.id.toString();
      var year = {{$request->year}};

      $.ajax({
          url: "{{ route('ehr.hetg.operating_room_programming.updateMyEvent') }}",
          type: 'post',
          data:{operating_room_id:operating_room_id, specialty_id:specialty_id,start_date_start:start_date_start, start_date:start_date,end_date_start:end_date_start, end_date:end_date, year:year, tipo:tipo},
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
      });
    }

    function deleteMyData(event, tipo) {
        let start_date = formatDateWithHour(event.start);
        let end_date = formatDateWithHour(event.end);

        let operating_room_id = {{$request->operating_room}};
        let specialty_id = event.id.toString();
        var year = {{$request->year}};

      $.ajax({
          url: "{{ route('ehr.hetg.operating_room_programming.deleteMyEvent') }}",
          type: 'post',
          data:{operating_room_id:operating_room_id, specialty_id:specialty_id,start_date:start_date, end_date:end_date, year:year, tipo:tipo},
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
      });
    }

    function deleteMyDataForce(event, tipo) {
        let start_date = formatDateWithHour(event.start);
        let end_date = formatDateWithHour(event.end);

        let operating_room_id = {{$request->operating_room}};
        let specialty_id = event.id.toString();
        var year = {{$request->year}};

      $.ajax({
          url: "{{ route('ehr.hetg.operating_room_programming.deleteMyEventForce') }}",
          type: 'post',
          data:{operating_room_id:operating_room_id, specialty_id:specialty_id,start_date:start_date, end_date:end_date, year:year, tipo:tipo},
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
