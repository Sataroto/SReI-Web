<!--
    Versión 1.0
    Creado al 11/10/2020
    Creado por: GBautista
    Copyright SReI
-->

@extends('layouts.layout')

@section('css')
@stop


@section('content')
<textarea name="ejemplo" id="texto" cols="30" rows="10"></textarea>
<button type="button"
    class="btn btn-success waves-effect m-r-10 m-b-10"
    onclick="Magic()">Magic
</button>
<button type="button"
    class="btn btn-success waves-effect m-r-10 m-b-10"
    onclick="down()">Magic
</button>
    <section id="image">
        <div id="QR" style = "width: 256px; height: 256px; "></div>
    </section> 
@stop()

@section('js')

<script src="{{asset('Template/custom-js/qrcode.min.js')}}"></script>
<script  src="{{asset('Template/custom-js/html2canvas.js')}}"></script>
<script>
    var texto = document.getElementById("texto");
    var qr = new QRCode(document.getElementById("QR"));

    function Magic(){
        var texval = texto.value;
        qr.makeCode(texval);
    }
    function down(){
        html2canvas(document.getElementById("QR"), {allowTaint:false, useCORS:true}).then(function(canvas) {
                window.scrollTo(0,0);
                console.log(canvas.toDataURL());
            }
        );
    }
</script>

@stop
