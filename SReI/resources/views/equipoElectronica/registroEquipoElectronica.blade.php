<!--
    Versión 1.0
    Creado al 15/01/2020
    Modificao al 15/01/2020
    Editado por: gbautista
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
                    {!!Form::open(array('url'=>'/equipoElectronica/nuevo',
                        'id'=>'addEquipForm', 'method'=>'POST'))!!}
                    <div class="row clearfix">
                        <div class="col-xs-3">
                            <h2 class="card-inside-title">Nombre</h2>
                            <div class="form-group">
                                <div class="form-line" id="bs_datepicker_container">
                                    {!!Form::text('nombre', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'nombre del equipo',
                                        'id'=>'nombre'])!!}
                                </div>
                            </div>

                            <h2 class="card-inside-title">Laboratorio</h2>
                            <div class="form-group">
                                <div class="form-line" id="ds_datepicker_container">
                                    {!!Form::select('laboratorio',
                                        $laboratorios, 0,
                                        ['class'=>'form-control',
                                        'id'=>'laboratorio'])!!}
                                </div>
                            </div>

                            <h2 class="card-inside-title">Fabricante</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('fabricante', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Fabricante del equipo',
                                        'id'=>'fabricante'])!!}
                                </div>
                            </div>

                            <h2 class="card-inside-title">Modelo</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('modelo', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Modelo del equipo',
                                        'id'=>'modelo'])!!}
                                </div>
                            </div>
                            <h2 class="card-inside-title">Descripción</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::textarea('descrip', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Descripción',
                                        'id'=>'modelo'])!!}
                                </div>
                            </div>
                            <h2 class="card-inside-title">Número de serie</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('serie', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Serie de equipo',
                                        'id'=>'modelo'])!!}
                                </div>
                            </div>
                            <h2 class="card-inside-title">Procedencia</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('procede', null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Procedencia',
                                        'id'=>'modelo'])!!}
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
