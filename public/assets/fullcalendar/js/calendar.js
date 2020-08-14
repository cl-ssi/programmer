document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var Draggable = FullCalendarInteraction.Draggable

  var containerEl = document.getElementById('external-events-list');
  new Draggable(containerEl, {
    itemSelector: '.fc-event'
    /*eventData: function(event) {
      console.log(event.serialize());
      return {
        title: event.innerText.trim(),
        id: event.innerText.trim()
      }
    }*/
  });

  var diff_ = 0;
  var calendar = new FullCalendar.Calendar(calendarEl, {
    schedulerLicenseKey: '0404885988-fcs-1582214203',
    plugins: [ 'interaction', 'resourceDayGrid', 'resourceTimeGrid', 'list' ],
    defaultView: 'resourceTimeGridDay',
    editable: true,
    selectable: true,
    eventLimit: true, // allow "more" link when too many events
    displayEventEnd: true,
    allDaySlot: false,

    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'resourceTimeGridDay,resourceTimeGridTwoDay,timeGridWeek,dayGridMonth'
    },
    locale: 'es', // the initial locale
    navLinks: true,

    views: {
      resourceTimeGridTwoDay: {
        type: 'resourceTimeGrid',
        duration: { days: 2 },
        buttonText: '2 days',
      }
    },


    //// uncomment this line to hide the all-day slot
    //allDaySlot: false,

    resources: [
      { id: '1', title: 'Pabellón 1' },
      { id: '2', title: 'Pabellón 2' },
      { id: '3', title: 'Pabellón 3' },
      { id: '4', title: 'Pabellón 4' },
      { id: '5', title: 'Pabellón 5' },
      { id: '6', title: 'Pabellón 6' },
      { id: '7', title: 'Pabellón 7' },
      //{ id: '8', title: 'Maternidad' }

      //eventColor: 'green'
    ],



    // events: [
    //   //TRAUMATOLOGÍA VERDE
    //   //CX ROJO
    //   //OFT AZUL
    //   // background event, associated with a resource
    //   { id: 'bg1', resourceId: ['1'], rendering: 'background', color:'green', start: '2020-02-10T08:00:00', end: '2020-02-10T13:00:00' },
    //   { id: 'bg2', resourceId: ['2'], rendering: 'background', color:'red', start: '2020-02-10T08:00:00', end: '2020-02-10T13:00:00' },
    //   { id: 'bg3', resourceId: ['3'], rendering: 'background', color:'blue', start: '2020-02-10T08:00:00', end: '2020-02-10T13:00:00' },
    //   { id: 'bg4', resourceId: ['4'], rendering: 'background', color:'green', start: '2020-02-10T08:00:00', end: '2020-02-10T10:30:00' },
    //   { id: 'bg4', resourceId: ['4'], rendering: 'background', color:'red', start: '2020-02-10T10:45:00', end: '2020-02-10T13:00:00' },
    //   { id: 'bg5', resourceId: ['5'], rendering: 'background', color:'brown', start: '2020-02-10T08:00:00', end: '2020-02-10T13:00:00' },
    //   { id: 'bg6', resourceId: ['6'], rendering: 'background', color:'red', start: '2020-02-10T08:00:00', end: '2020-02-10T13:00:00' },
    //   { id: 'bg1', resourceId: ['7'], rendering: 'background', color:'green', start: '2020-02-10T08:00:00', end: '2020-02-10T13:00:00' },
    //
    //
    //   // { id: '1', resourceId: '1', start: '2019-08-06', end: '2019-08-08', title: 'event 1' },
    //   // { id: '2', resourceId: '1', start: '2019-08-07T09:00:00', end: '2019-08-07T14:00:00', title: 'event 2' },
    //   // { id: '3', resourceId: '2', start: '2019-08-07T12:00:00', end: '2019-08-08T06:00:00', title: 'event 3' },
    //   // { id: '4', resourceId: '3', start: '2019-08-07T07:30:00', end: '2019-08-07T09:30:00', title: 'event 4' },
    //   // { id: '5', resourceId: '4', start: '2019-08-07T10:00:00', end: '2019-08-07T15:00:00', title: 'event 5' }
    //
    //   { id: '1',
    //     resourceId: '1',
    //     title: 'Dr. Barreda',
    //     start: '2020-02-10T08:00:00',
    //     end: '2020-02-10T10:30:00',
    //     color: 'green'
    //   },
    //   { id: '2',
    //     resourceId: '1',
    //     title: 'Dr. Barreda',
    //     start: '2020-02-10T10:45:00',
    //     end: '2020-02-10T12:00:00',
    //     color: 'green'
    //   },
    //
    //   { id: '3',
    //     resourceId: '7',
    //     title: 'Dr. Vega',
    //     start: '2020-02-10T08:00:00',
    //     end: '2020-02-10T10:00:00',
    //     color: 'green'
    //   },
    //   { id: '4',
    //     resourceId: '7',
    //     title: 'Dr. Vega',
    //     start: '2020-02-10T10:15:00',
    //     end: '2020-02-10T11:30:00',
    //     color: 'green'
    //   },
    //   { id: '5',
    //     resourceId: '7',
    //     title: 'Dr. Vega',
    //     start: '2020-02-10T11:45:00',
    //     end: '2020-02-10T13:00:00',
    //     color: 'green'
    //   },
    //
    //   { id: '6',
    //     resourceId: '2',
    //     title: 'Dr. Barra',
    //     start: '2020-02-10T08:00:00',
    //     end: '2020-02-10T10:00:00',
    //     color: 'red'
    //   },
    //   { id: '7',
    //     resourceId: '2',
    //     title: 'Dr. Barra',
    //     start: '2020-02-10T10:15:00',
    //     end: '2020-02-10T11:30:00',
    //     color: 'red'
    //   },
    //   { id: '8',
    //     resourceId: '2',
    //     title: 'Dr. Barra',
    //     start: '2020-02-10T11:45:00',
    //     end: '2020-02-10T13:00:00',
    //     color: 'red'
    //   },
    //
    //   { id: '9',
    //     resourceId: '3',
    //     title: 'Dr. Muñoz',
    //     start: '2020-02-10T08:00:00',
    //     end: '2020-02-10T10:00:00',
    //     color: 'blue'
    //   },
    //   { id: '10',
    //     resourceId: '3',
    //     title: 'Dr. Muñoz',
    //     start: '2020-02-10T10:15:00',
    //     end: '2020-02-10T11:30:00',
    //     color: 'blue'
    //   },
    //   { id: '11',
    //     resourceId: '3',
    //     title: 'Dr. Muñoz',
    //     start: '2020-02-10T11:45:00',
    //     end: '2020-02-10T13:00:00',
    //     color: 'blue'
    //   },
    //
    //   { id: '12',
    //     resourceId: '4',
    //     title: 'Dr. González',
    //     start: '2020-02-10T08:00:00',
    //     end: '2020-02-10T09:30:00',
    //     color: 'green'
    //   },
    //   { id: '13',
    //     resourceId: '4',
    //     title: 'Dr. González',
    //     start: '2020-02-10T09:40:00',
    //     end: '2020-02-10T10:00:00',
    //     color: 'green'
    //   },
    //
    //   { id: '14',
    //     resourceId: '4',
    //     title: 'Dr. Ruiz',
    //     start: '2020-02-10T10:45:00',
    //     end: '2020-02-10T12:00:00',
    //     color: 'red'
    //   },
    //
    // ],

    select: function(arg) {
      console.log(
        'select',
        arg.startStr,
        arg.endStr,
        arg.resource ? arg.resource.id : '(no resource)'
      );
    },
    dateClick: function(arg) {
      console.log(
        'dateClick',
        arg.date,
        arg.resource ? arg.resource.id : '(no resource)'
      );
    },

    eventRender: function (info) {
      //console.log(info.event.extendedProps);
      // {description: "Lecture", department: "BioChemistry"}
      console.log(info.event);
    },

    eventReceive: function(info) {
      var fecha_inicio = info.event.start;
      info.event.setEnd(add_minutes(fecha_inicio,60));
      //alert(info.event.id);
      //alert(info.event.end);

      //info.event.color: 'purple';

      //traumatologos
      if(info.event.id == "111"){
        // if((bolsa_111 - 1) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
        document.getElementById("111").innerHTML = (bolsa_111 - 1);
        bolsa_111 = bolsa_111 - 1;
        document.getElementById("total_traumatologia").innerHTML = bolsa_111 + bolsa_222 + bolsa_333;
      }
      if(info.event.id == "222"){
        document.getElementById("222").innerHTML = (bolsa_222 - 1);
        bolsa_222 = bolsa_222 - 1;
        document.getElementById("total_traumatologia").innerHTML = bolsa_111 + bolsa_222 + bolsa_333;
      }
      if(info.event.id == "333"){
        document.getElementById("333").innerHTML = (bolsa_333 - 1);
        bolsa_333 = bolsa_333 - 1;
        document.getElementById("total_traumatologia").innerHTML = bolsa_111 + bolsa_222 + bolsa_333;
      }

      //oftalmologia
      if(info.event.id == "444"){
        document.getElementById("444").innerHTML = (bolsa_444 - 1);
        bolsa_444 = bolsa_444 - 1;
        document.getElementById("total_oftalmologia").innerHTML = bolsa_444 + bolsa_555;
      }
      if(info.event.id == "555"){
        document.getElementById("555").innerHTML = (bolsa_555 - 1);
        bolsa_555 = bolsa_555 - 1;
        document.getElementById("total_oftalmologia").innerHTML = bolsa_444 + bolsa_555;
      }

      //cuirugía
      if(info.event.id == "666"){
        document.getElementById("666").innerHTML = (bolsa_666 - 1);
        bolsa_666 = bolsa_666 - 1;
        document.getElementById("total_cirugia").innerHTML = bolsa_666 + bolsa_777 + bolsa_888 + bolsa_999;
      }
      if(info.event.id == "777"){
        document.getElementById("777").innerHTML = (bolsa_777 - 1);
        bolsa_777 = bolsa_777 - 1;
        document.getElementById("total_cirugia").innerHTML = bolsa_666 + bolsa_777 + bolsa_888 + bolsa_999;
      }
      if(info.event.id == "888"){
        document.getElementById("888").innerHTML = (bolsa_888 - 1);
        bolsa_888 = bolsa_888 - 1;
        document.getElementById("total_cirugia").innerHTML = bolsa_666 + bolsa_777 + bolsa_888 + bolsa_999;
      }
      if(info.event.id == "999"){
        document.getElementById("999").innerHTML = (bolsa_999 - 1);
        bolsa_999 = bolsa_999 - 1;
        document.getElementById("total_cirugia").innerHTML = bolsa_666 + bolsa_777 + bolsa_888 + bolsa_999;
      }

    },

    // eventDrop: function(info) {
    //   alert(info.event.title + " was dropped on " + info.event.start.toISOString());
    //
    //   if (!confirm("Are you sure about this change?")) {
    //     info.revert();
    //   }
    // }

    //obtengo valor previo de hora de bloque
    eventResizeStart: function(info){
      var inicio = info.event.start;
      var termino = info.event.end;
      var diff =(termino.getTime() - inicio.getTime()) / 1000;
      diff /= 60;
      diff_ = diff/60;
      //alert(diff_);
    },

    eventResize: function(info) {
      var inicio = info.event.start;
      var termino = info.event.end;
      var diff =(termino.getTime() - inicio.getTime()) / 1000;
      diff /= 60;
      diff = (diff/60) - diff_;

      //info.revert();

      //traumatologos
      if(info.event.id == "111"){
        if((bolsa_111 - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
        document.getElementById("111").innerHTML = (bolsa_111 - diff);
        bolsa_111 = bolsa_111 - diff;
        document.getElementById("total_traumatologia").innerHTML = bolsa_111 + bolsa_222 + bolsa_333;
      }
      if(info.event.id == "222"){
        if((bolsa_222 - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
        document.getElementById("222").innerHTML = (bolsa_222 - diff);
        bolsa_222 = bolsa_222 - diff;
        document.getElementById("total_traumatologia").innerHTML = bolsa_111 + bolsa_222 + bolsa_333;
      }
      if(info.event.id == "333"){
        if((bolsa_333 - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
        document.getElementById("333").innerHTML = (bolsa_333 - diff);
        bolsa_333 = bolsa_333 - diff;
        document.getElementById("total_traumatologia").innerHTML = bolsa_111 + bolsa_222 + bolsa_333;
      }

      //oftalmologia
      if(info.event.id == "444"){
        if((bolsa_444 - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
        document.getElementById("444").innerHTML = (bolsa_444 - diff);
        bolsa_444 = bolsa_444 - diff;
        document.getElementById("total_oftalmologia").innerHTML = bolsa_444 + bolsa_555;
      }
      if(info.event.id == "555"){
        if((bolsa_555 - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
        document.getElementById("555").innerHTML = (bolsa_555 - diff);
        bolsa_555 = bolsa_555 - diff;
        document.getElementById("total_oftalmologia").innerHTML = bolsa_444 + bolsa_555;
      }

      //cuirugía
      if(info.event.id == "666"){
        if((bolsa_666 - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
        document.getElementById("666").innerHTML = (bolsa_666 - diff);
        bolsa_666 = bolsa_666 - diff;
        document.getElementById("total_cirugia").innerHTML = bolsa_666 + bolsa_777 + bolsa_888 + bolsa_999;
      }
      if(info.event.id == "777"){
        if((bolsa_777 - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
        document.getElementById("777").innerHTML = (bolsa_777 - diff);
        bolsa_777 = bolsa_777 - diff;
        document.getElementById("total_cirugia").innerHTML = bolsa_666 + bolsa_777 + bolsa_888 + bolsa_999;
      }
      if(info.event.id == "888"){
        if((bolsa_888 - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
        document.getElementById("888").innerHTML = (bolsa_888 - diff);
        bolsa_888 = bolsa_888 - diff;
        document.getElementById("total_cirugia").innerHTML = bolsa_666 + bolsa_777 + bolsa_888 + bolsa_999;
      }
      if(info.event.id == "999"){
        if((bolsa_999 - diff) < 0){alert("Excedió horas semanales contratas.");info.revert();return;} //revierte si se llega a cero
        document.getElementById("999").innerHTML = (bolsa_999 - diff);
        bolsa_999 = bolsa_999 - diff;
        document.getElementById("total_cirugia").innerHTML = bolsa_666 + bolsa_777 + bolsa_888 + bolsa_999;
      }
    }


  });

  var add_minutes =  function (dt, minutes) {
      return new Date(dt.getTime() + minutes*60000);
  }



  calendar.setOption('locale', 'es');
  calendar.render();
});
