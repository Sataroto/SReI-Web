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
@stop


@section('content')
<div id='calendar'></div>

@stop()

@section('js')
<script src="{{asset('Template/plugins/fullcalendar/lib/moment.min.js')}}"></script>
<script src="{{asset('Template/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('Template/plugins/fullcalendar/locale/es.js')}}"></script>
<script>
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
            click: function() {//listener del boton
              alert('clicked the custom button!');
            }
          }
        },
        // ocultamos los domingos por ser dia no avil
        hiddenDays: [ 0 ],

        //listener de casilla
        dayClick: function(date, jsEvent, view) {
          alert('Clicked on: ' + date.format());
        }


      })
  });

</script>
@stop