<!--
    Versión 1.0
    Creado al 15/01/2020
    Modificao al 16/01/2020
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
                    Electrónica
                    <small>Lista de equipo en los laboratorios de ligeros</small>
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
                            <th>Laboratorio</th>
                            <th>Descripción</th>
                            <th># de Serie</th>
                            <th>Procedencia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Fin de la cabecera de la tabla -->

                    <!-- Cuerpo de la tabla -->
                    <tbody>
                        @unless($equipoElectronica == null)
                            @foreach($equipoElectronica as $m)
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

                                    <td>
                                        @unless(sizeof($m->caracteristicas)<=2)
                                        <p>{{$m->caracteristicas[2]}}</p>
                                        <b hidden>{{$m->caracteristicas[2]}}</b>
                                        <div class="form-group" hidden>
                                            <div class="form-line">
                                              {!!Form::textarea('descrip',
                                              $m->caracteristicas[2],
                                              ['class'=>'form-control','id'=>'descrip'])!!}
                                            </div>
                                        </div>
                                        @endunless
                                    </td>

                                    <td>
                                        @unless(sizeof($m->caracteristicas)<=3)
                                        <p>{{$m->caracteristicas[3]}}</p>
                                        <b hidden>{{$m->caracteristicas[3]}}</b>
                                        <div class="form-group" hidden>
                                            <div class="form-line">
                                                {!!Form::text('numSerie',
                                                $m->caracteristicas[3],
                                                ['class'=>'form-control', 'id'=>'numSerie'])!!}
                                            </div>
                                        </div>
                                        @endunless
                                    </td>
                                    <td>
                                        @unless(sizeof($m->caracteristicas)<=4)
                                        <p>{{$m->caracteristicas[4]}}</p>
                                        <b hidden>{{$m->caracteristicas[4]}}</b>
                                        <div class="form-group" hidden>
                                            <div class="form-line">
                                                {!!Form::text('procede',
                                                $m->caracteristicas[4],
                                                ['class'=>'form-control', 'id'=>'procede'])!!}
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
<script src="{{asset('Template/custom-js/editEE.js')}}"></script>
<script src="{{asset('Template/custom-js/editButtons.js')}}"></script>
@stop
