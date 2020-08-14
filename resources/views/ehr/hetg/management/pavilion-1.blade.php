@extends('layouts.app')

@section('title', 'Formulario de requerimiento')

@section('content')

<h3 class="mb-3">Programación de Formularios Quirúrgicos.</h3>

@include('surgical_pavilion.partials.nav')

<hr>

<h5 class="mb-3"></h5>

  <div id='wrap'>

    <div id='external-events'>
      <h4>Draggable Events</h4>

      <div id='external-events-list'>
        <div class='fc-event'>My Event 1</div>
        <div class='fc-event'>My Event 2</div>
        <div class='fc-event'>My Event 3</div>
        <div class='fc-event'>My Event 4</div>
        <div class='fc-event'>My Event 5</div>
      </div>

      <p>
        <input type='checkbox' id='drop-remove' />
        <label for='drop-remove'>remove after drop</label>
      </p>
    </div>

    <div id='calendar'></div>

    <div style='clear:both'></div>

  </div>

  <div id='calendar'></div>

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
  <script src='{{asset('assets/fullcalendar/packages/list/main.js')}}'></script>

  <script src='{{asset('assets/fullcalendar/js/calendar.js')}}'></script>

  <script src='{{asset('assets/fullcalendar/packages/core/locales-all.js')}}'></script>
  @endsection

  @section('custom_js_head')



  @endsection
