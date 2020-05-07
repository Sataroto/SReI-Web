<!--
    Versión 1.0
    Creado al 15/01/2020
    Modificao al 07/05/2020
    Editado por: GBautista
    Copyright SReI
-->

@extends('layouts.layout')

@section('css')
@stop


@section('content')
    <video id="video"  name="video" playsinline autoplay style="display: none"></video> 
    <canvas id="videoCanvas"></canvas>
    <button id="reset">Reset</button>
    <button id="stop" >Stop</button>

    <p id="result"> ejemplo</p>


@stop()

@section('js')
<script src="{{asset('Template/custom-js/qcode-decoder/build/qcode-decoder.min.js')}}"></script>
<!--Descomentar para ver canvas-->
<!--script src="{{asset('Template/custom-js/photo.js')}}"></script-->

<!--
  Script prueba para ver lectura de QR
  No tiene lineas de falla, pero tampoco mmuestra alerts
  dado a que son las 3 de la mañana no tengo idea si es mi navegador, cache, o algo puse mal
  si alguien tiene tiempo de probarlo sería cuestion de probar la ruta y ver si en otro navegador
  tiene una respuesta distinta

  En caso de funcionar, avisar para poder estructurarlo de forma formal a otro js en custom-js
-->
<script  type="text/javascript">
 (function () {
    'use strict';

    var qr = new QCodeDecoder();

    if (!(qr.isCanvasSupported() && qr.hasGetUserMedia())) {
      alert('Your browser doesn\'t match the required specs.');
      throw new Error('Canvas and getUserMedia are required');
    }

    var video = document.getElementById('video');
    var reset = document.getElementById('reset');
    var stop = document.getElementById('stop');
    var valor = document.getElementById('result');

    function resultHandler (err, result) {
      if (err)  alert("help");
      alert(result);
    }

    // prepare a canvas element that will receive
    // the image to decode, sets the callback for
    // the result and then prepares the
    // videoElement to send its source to the
    // decoder.

   
    qr.decodeFromCamera(video, function(er,res){
      alert(res);
    });


    // attach some event handlers to reset and
    // stop whenever we want.

    reset.onclick = function () {
      qr.decodeFromCamera(video, resultHandler);
    };

    stop.onclick = function () {
      qr.stop();
    };

  })();
  </script>
@stop
