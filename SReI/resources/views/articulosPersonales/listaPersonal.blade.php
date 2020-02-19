<!--
    Versión 1.0
    Editado por: Rrios
    Copyright SReI
-->

<?php
    $estados = [
        "Averiado",
        "En buen estado",
        "En mantenimiento"
    ];
?>

@extends('layouts.layout')

@section('css')

@stop


@section('popUp')
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <!-- Inicio del formulario -->
    {!!Form::open(array('url'=>'/personal/nuevo',
        'id'=>'addEquipForm', 'method'=>'POST'))!!}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                <!-- Contenedor del formulario -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-8">
                                <h5 class="card-inside-title">Nombre</h5>
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
                                        {!!Form::textarea('descrip', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Descripción',
                                            'id'=>'modelo'])!!}
                                    </div>
                                </div>
                                <h5 class="card-inside-title">Número de serie</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('serie', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Serie de equipo',
                                            'id'=>'modelo'])!!}
                                    </div>
                                </div>
                                <h5 class="card-inside-title">Foto</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('foto', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Inserta una foto',
                                            'id'=>'modelo'])!!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin del contenedor del formulario -->

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-link waves-effect">Enviar</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
    <!-- Fin del formulario -->
</div>
@stop

@section('content')
<!-- Contenedor de la lista -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Equipo Personal
                    <small>Lista de equipo personal</small>
                    <ul class="header-dropdown m-r--5">
                        <button type="button" class="btn btn-success waves-effect m-r-20"
                        data-toggle="modal" data-target="#defaultModal">Nuevo</button>
                    </ul>
                </h2>
            </div>
            <!-- Inicio de la tabla -->
            <div class="body table-responsive">
                <table class="table">
                    <!--Cabecera de la tabla -->
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre del equipo</th>
                            <th>Fabricante</th>
                            <th>Modelo</th>
                            <th>Estado</th>
                            <th>Foto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Fin de la cabecera de la tabla -->

                    <!-- Cuerpo de la tabla -->
                    <tbody>

                    </tbody>
                    <!-- Find el cuerpo de la tabla -->
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Fin del contenedor de la lista -->
@stop()

@section('js')
<script src="{{asset('Template/custom-js/editTarjeta.js')}}"></script>
<script src="{{asset('Template/custom-js/editButtons.js')}}"></script>
@stop
