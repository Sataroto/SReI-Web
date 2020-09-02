<!--
    Versión 1.3
    Creado al 30/08/2020
    Creado por: GBautista
    Modificado al: 01/09/2020
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

@section('popUp')
<!-- Modal de creacion -->
<div class="modal fade" id="addMantenimiento" tabindex="-1" role="dialog">
    <!-- Inicio del formulario -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Nuevo mantenimiento</h5>
            </div>
            <div class="modal-body">
                <!-- Contenedor del formulario -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-8">
                                <h5 class="modal-title">Nombre</h5>
                                <div class="form-group">
                                    <div class="form-line" id="bs_datepicker_container">
                                    <input type="text" id="nameMant">
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Fecha inicial</h5>
                                <div class="form-group">
                                    <div class="form-line" id="ds_datepicker_container">
                                      <div id = "FI"> </div>
                                      <input type="date" id="dateStart">
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Fecha final</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="date" id="dateEnd">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" onClick="actualizar()">Enviar</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    <!-- Fin del formulario mantenimiento -->
</div>
<!-- Fin modal -->

@stop

@section('content')
<div id='calendar'></div>
@stop()

@section('js')
<script src="{{asset('Template/plugins/fullcalendar/lib/moment.min.js')}}"></script>
<script src="{{asset('Template/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('Template/plugins/fullcalendar/locale/es.js')}}"></script>
<script>
function actualizar(){
  var nameEv = document.getElementById("nameMant").value;
  var sD = document.getElementById("dateStart").value;
  var eD = document.getElementById("dateEnd").value;
  sD = moment(sD);
  eD = moment(eD);
  if (sD.isValid() && eD.isValid()){
    $('#calendar').fullCalendar('renderEvent', {
            title: nameEv,
            start: sD,
            end: eD,
            allDay: false
          });
  }else{
    alert('error.');
  }
  $('#addMantenimiento').modal('toggle');
}
</script>
<script>
  var mantenimientos =[];//arreglo de colecciones
  $(document).ready(function() { 

    //window.toggel = function(){ $('#addMantenimiento').modal('toggle');}

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
            click: function(){
              //document.getElementById("demo").innerHTML = x;

              $('#addMantenimiento').modal('toggle');
            },
          }
        },
        // ocultamos los domingos por ser dia no avil
        hiddenDays: [ 0 ],
        //listener de casilla
        dayClick:function(date,jsEvent, view){
            $('#addMantenimiento').modal('toggle');
            document.getElementById("dateStart").value = date.format();
            document.getElementById("dateEnd").value = date.add(1,"day").format();
          }, 
        businessHours: { // horas de trabajo
          // dias de la semana
          dow: [ 1, 2, 3, 4, 5, 6 ], 

          start: '07:00', 
          end: '16:00', 
        },
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