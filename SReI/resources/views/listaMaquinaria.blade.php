<!--
    Versión 1.0
    Creado al 17/12/2019
    Modificao al 06/01/2020
    Editado por: obelmonte
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

@section('content')
<!-- Contenedor de la lista -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Maquinaria
                    <small>Lista de maquinaria en los laboratorios de pesados</small>
                </h2>
            </div>
            <!-- Inicio de la tabla -->
            <div class="body table-responsive">
                <table class="table">
                    <!--Cabecera de la tabla -->
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre de la maquina</th>
                            <th>Fabricante</th>
                            <th>Modelo</th>
                            <th>Estado</th>
                            <th>Laboratorio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Fin de la cabecera de la tabla -->

                    <!-- Cuerpo de la tabla -->
                    <tbody>
                        @unless($maquina == null)
                            @foreach($maquina as $m)
                                <tr id="{{$m->_id}}">
                                    <th scope="row">{{$m->_id}}</th>
                                    <td>
                                        <p>{{$m->nombre}}</p>
                                        <div class="form-group" hidden>
                                            <div class="form-line">
                                                {!!Form::text('nombre',$m->nombre,['class'=>'form-control', 'id'=>'nombre'])!!}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p>{{$m->caracteristicas[0]}}</p>
                                        <div class="form-group" hidden>
                                            <div class="form-line">
                                                {!!Form::text('fabricante',$m->caracteristicas[0],['class'=>'form-control', 'id'=>'fabricante'])!!}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p>{{$m->caracteristicas[1]}}</p>
                                        <div class="form-group" hidden>
                                            <div class="form-line">
                                                {!!Form::text('modelo',$m->caracteristicas[1],['class'=>'form-control', 'id'=>'modelo'])!!}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p>
                                            @if($m->estado == 0)
                                                Averiado
                                            @elseif($m->estado == 1)
                                                En buen estado
                                            <!Este estado esta sujeto a cambios>
                                            @elseif($m->estado == 2)
                                                En mantenimiento
                                            @endif
                                        </p>
                                        <b hidden>{{$m->estado}}</b>
                                        <div class="form-group" hidden>
                                            <div class="form-line">
                                                {!!Form::select('estado',$estados,$m->estado,['class'=>'form-control', 'id'=>'estado'])!!}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @unless($m->laboratorio == null)
                                        <p>
                                                {{$m->lab->nombre}}
                                        </p>
                                        <b hidden>{{$m->lab->_id}}</b>
                                        <div class="form-group" hidden>
                                            <div class="form-line">
                                                {!!Form::select('estado',$laboratorios,$m->lab->_id,['class'=>'form-control', 'id'=>'estado'])!!}
                                            </div>
                                        </div>
                                        @endunless
                                    </td>

                                    <!-- Botones de acción -->
                                    <th id="action_buttons">
                                        <button type="button"
                                            class="btn btn-primary m-t-6 waves-effect"
                                            onclick="edit('{{$m->_id}}');">

                                            <i class="material-icons">mode_edit</i>
                                        </button>
                                        <btton type="button"
                                            class="btn btn-danger m-t-6 waves-effect"
                                            onclick="destroy('{{$m->_id}}');">

                                            <i class="material-icons">delete</i>
                                        </button>
                                    </th>
                                    <!-- Fin de botones de acción -->

                                    <th id="edit_buttons" hidden>
                                        <button type="button"
                                            class="btn btn-primary m-t-15 waves-effect"
                                            onclick="send('{{$m->_id}}');">

                                            <i class="material-icons">send</i>
                                        </button>
                                        <button type="button"
                                            class="btn btn-danger m-t-15 waves-effect"
                                            onclick="cancel('{{$m->_id}}')">

                                            <i class="material-icons">close</i>
                                        </button>
                                    </th>
                                </tr>
                            @endforeach
                        @endunless
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
<script src="{{asset('Template/custom-js/editMaquina.js')}}"></script>
@stop
