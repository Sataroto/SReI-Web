<!--
    Versión 1.2
    Creado al 30/08/2020
    Creado por: GBautista
    Modificado al: 31/08/2020
    Editado por: GBautista
    Copyright SReI
-->

@extends('layouts.layout')

@section('css')
<link href="{{asset('Template/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" />
<style>
#calendar {
  max-width: 800px;
  max-height: 800px;
  margin: 10px auto;
}
</style>
@stop


@section('content')
<div id='calendar'></div>

@stop()

@section('js')
<script src="{{asset('Template/plugins/fullcalendar/lib/moment.min.js')}}"></script>
<script src="{{asset('Template/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('Template/plugins/fullcalendar/locale/es.js')}}"></script>
<script>
  var mantenimientos =[];//arreglo de colecciones
  $(function(){
    $("#calendar").fullCalendar(
      {
        header: { //presentacion con boton customizado
          left: 'title',
          center: '', 
          right:'add, today, prev,next'
        },
        //aplicar formato al nombre-fecha
        views: {
          month: { // name of view
            titleFormat: 'MMMM / YYYY'
          }
        },

        //para que haga juego con el tema, deberia cambiarse a la version 3.5
        //una opcion no tan necesaria, cuestion de gustos
        //themeSystem:'bootstrap3',
        
        customButtons: { //boton customizado
          add: {
            text: 'Nuevo',
            //bootstrapGlyphicon:'glyphicon glyphicon-plus-sign',
            click: function() {
                    var nameEv = prompt('Name your new event:');
                    var dateStr = prompt('Enter a date in YYYY-MM-DD format');
                    var date = moment(dateStr);

                    if (date.isValid()) {
                      $('#calendar').fullCalendar('renderEvent', {
                        title: nameEv,
                        start: date,
                        allDay: true
                      });
                      alert('Great. Now, update your database...');
                    } else {
                      alert('Invalid date.');
                    }
                  }
          }
        },
        // ocultamos los domingos por ser dia no avil
        hiddenDays: [ 0 ],
        //listener de casilla
        dayClick: function(date, jsEvent, view) {
          alert('Clicked on: ' + date.format());
        },
        businessHours: { // horas de trabajo
          // dias de la semana
          dow: [ 1, 2, 3, 4, 5, 6 ], 

          start: '07:00', 
          end: '16:00', 
        },
/*
 Este elemento se presentara para jalar los elementos de la API
 el formato JSON debe ser un arreglo de colecciones del tipo:
 [
  {
    title  : 'event1',
    start  : '2010-01-01'
  },
  {
    title  : 'event2',
    start  : '2010-01-05',
    end    : '2010-01-07'
  },
  {
    title  : 'event3',
    start  : '2010-01-09T12:30:00',
  }
 ]
*/
        eventSources: [

          // your event source
          {
            events:mantenimientos,
            color: 'yellow',    // an option!
            textColor: 'black'  // an option!
          }

          // any other sources...

          ]

      })
  });
</script>
@stop