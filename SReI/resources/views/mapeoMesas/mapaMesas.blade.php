<!--
    Versión 1.0
    Creado al 13/01/2020
    Modificao al 13/01/2020
    Editado por: mlopez
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
                    {!!Form::open(array('url'=>'/mapeo-mesas/mapa',
                        'id'=>'add_mapm_form', 'method'=>'POST'))!!}
                    <div class="row clearfix">
                        <div class="col-xs-3">
                            <h5 class="card-inside-title">Nombre tarjeta</h5>
                            <div class="form-group">
                                <div class="form-line" id="bs_datepicker_container">
                                    {!!Form::text('nombre', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'nombre de la tarjeta',
                                        'id'=>'nombre'])!!}
                                </div>
                            </div>

                            <h5 class="card-inside-title">Laboratorio</h5>
                            <div class="form-group">
                                <div class="form-line" id="ds_datepicker_container">
                                    {!!Form::select('laboratorio',
                                        $laboratorios, 0,
                                        ['class'=>'form-control',
                                        'id'=>'laboratorio'])!!}
                                </div>
                            </div>

                            <h5 class="card-inside-title">Fabricante</h5>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('fabricante', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Fabricante de la tarjeta',
                                        'id'=>'fabricante'])!!}
                                </div>
                            </div>

                            <h5 class="card-inside-title">Modelo</h5>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('modelo', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Modelo de la tarjeta',
                                        'id'=>'modelo'])!!}
                                </div>
                            </div>

                            <h5 class="card-inside-title">Descripción</h5>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::textarea('descripcion', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Descripción de la tarjeta',
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

@stop()
