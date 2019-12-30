<!--
    Versión 1.0
    Creado al 19/12/2019
    Modificao al 30/12/2019
    Editado por: obelmonte
    Copyright SReI
-->

@extends('layouts.layout')

@section('content')
<!-- Contenedor del formulario -->
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <!-- Inicio del formulario -->
                    {!!Form::open(array('url'=>'/registroMaquina',
                        'id'=>'addMaquinaForm', 'method'=>'POST'))!!}
                    <div class="row clearfix">
                        <div class="col-xs-3">
                            <h2 class="card-inside-title">Nombre</h2>
                            <div class="form-group">
                                <div class="form-line" id="bs_datepicker_container">
                                    {!!Form::text('nombre', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'nombre de la maquina',
                                        'id'=>'nombre'])!!}
                                </div>
                            </div>

                            <h2 class="card-inside-title">Laboratorio</h2>
                            <div class="form-group">
                                <div class="form-line" id="ds_datepicker_container">
                                    {!!Form::select('laboratorio',
                                        ['soldadura','otro'], 0,
                                        ['class'=>'form-control',
                                        'id'=>'laboratorio'])!!}
                                </div>
                            </div>

                            <h2 class="card-inside-title">Fabricante</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('fabricante', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Fabricante de la maquina',
                                        'id'=>'fabricante'])!!}
                                </div>
                            </div>

                            <h2 class="card-inside-title">Modelo</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('modelo', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Modelo de la maquina',
                                        'id'=>'modelo'])!!}
                                </div>
                            </div>

                            <!--seccion de checklist-->
                            <h2 class="card-inside-title">Checklist</h2>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="input-group spinner" data-trigger="spinner">
                                        <div class="form-line">
                                            {!!Form::text('n_checklist', 1,
                                                ['class'=>'form-control text-center',
                                                'onchange'=>'updateCheklist();',
                                                'data-rule'=>'quantity',
                                                'id'=>'n_checklist'])!!}
                                        </div>

                                        <span class="input-group-addon">
                                            <a href="javascript:;" class="spin-up"
                                                data-spin="up" id="add">

                                                <i class="glyphicon glyphicon-chevron-up"></i>
                                            </a>
                                            <a href="javascript:;" class="spin-down"
                                                data-spin="down" id="rmv">

                                                <i class="glyphicon glyphicon-chevron-down"></i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección de checklist -->
                            <table id="checkList_table">
                                <div id="checklist_container">

                                </div>
                            </table>
                            <!-- Fin del checklist -->
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
    document.getElementById('addMaquinaForm').addEventListener('keypress', function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });
</script>
@stop()
