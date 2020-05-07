<!--
    Versión 3.0
    Creado al 15/01/2020
    Creado por: GBautista
    Modificao al 07/05/2020
    Editado por: GBautista
    Copyright SReI
-->

@extends('layouts.layout')

@section('css')
@stop


@section('content')
    <video id="preview"></video> 

    <p id="result"></p>


@stop()

@section('js')
<!--
  Script funcional en linea
  Es necesario tener internet para que funcione
  Posible mejora es encontrar ese script funcional de forma local
<script src="{{asset('Template/custom-js/instascan.min.js')}}"></script>
-->
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js" ></script>
<!--
    Scanner sacado de git https://github.com/rcarneironet/qrcode-js
    Aplicación de : https://github.com/schmich/instascan 
-->
<script>
        let scanner = new Instascan.Scanner(
            {
                video: document.getElementById('preview')
            }
        );
        scanner.addListener('scan', function(content) {
            var texto = document.getElementById('result')
            texto.innerHTML = content
        });
        Instascan.Camera.getCameras().then(cameras => 
        {
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else {
                console.error("No existe la camara o dispositivo");
            }
        });
    </script>

@stop
