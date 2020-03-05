<!--
    Versión 1.0
    Creado al 15/01/2020
    Modificao al 16/01/2020
    Editado por: obelmonte
    Copyright SReI
-->

<!--
$image = __DIR__ . "/qrcodes/hello_world.png";
$qrcode = new QrReader($image);
$this->assertSame("Hello world!", $qrcode->text());
-->

<?php
use Zxing\QrReader;
?>

@extends('layouts.layout')

@section('css')
@stop


@section('content')
<!-- Stream video via webcam -->
<div class="video-wrap">
    <video id="video" playsinline autoplay></video>
</div>

<!-- Trigger canvas web API -->
<div class="controller">
    <button id="snap">Capture</button>
    <button id="can">Send</button>
</div>

<!-- Webcam video snapshot -->
<canvas id="canvas" width="640" height="360"></canvas>

@stop()

@section('js')

<script src="{{asset('Template/custom-js/photo.js')}}"></script>
@stop
