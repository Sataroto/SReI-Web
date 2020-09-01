

<!--
    Versión 1.1
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
    $("#calendar").fullCalendar();
  });

</script>
@stop