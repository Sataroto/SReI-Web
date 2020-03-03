<!--
    Versión 1.0
    Editado por: rrios
    Copyright SReI
-->

@extends('layouts.layout')

@section('content')
<!-- Contenedor del formulario -->
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <p>Corrige los siguientes errores:</p>
                <ul>
                    @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="body">
                    <!-- Inicio del formulario -->
                    {!!Form::open(array('url'=>'/personal/lista',
                        'id'=>'add_ap_form', 'method'=>'POST'))!!}
                    <div class="row clearfix">
                        <div class="col-xs-3">
                            <h5 class="card-inside-title">Nombre equipo</h5>
                            <div class="form-group">
                                <div class="form-line" id="bs_datepicker_container">
                                    {!!Form::text('nombre', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'nombre del equipo',
                                        'id'=>'nombre'])!!}
                                </div>
                            </div>

                            <h5 class="card-inside-title">Fabricante</h5>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('fabricante', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Fabricante del equipo',
                                        'id'=>'fabricante'])!!}
                                </div>
                            </div>

                            <h5 class="card-inside-title">Modelo</h5>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('modelo', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Modelo del equipo',
                                        'id'=>'modelo'])!!}
                                </div>
                            </div>

                            <h5 class="card-inside-title">Descripción</h5>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::textarea('descripcion', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Descripción del equipo',
                                        'id'=>'descripcion'])!!}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary waves-effect">Enviar</button>
                        </div>
                    </div>
                    {!!Form::close()!!}
                    <!-- Fin del formulario -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del contenedor del formulario -->
@stop()

@section('js')
<script src="{{asset('Template/custom-js/maquinariaForm.js')}}"></script>

<script>
    // Evita que el botón 'Enter' envie el formulario
    document.getElementById('addEquipForm').addEventListener('keypress', function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });
</script>
@stop()
