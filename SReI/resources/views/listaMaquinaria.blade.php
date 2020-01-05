<!--
    Versión 1.0
    Creado al 17/12/2019
    Modificao al 30/12/2019
    Editado por: obelmonte
    Copyright SReI
-->

@extends('layouts.layout')

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
                                    <td>{{$m->nombre}}</td>
                                    <td>{{$m->caracteristicas[0]}}</td>
                                    <td>{{$m->caracteristicas[1]}}</td>
                                    <td>
                                        @if($m->estado == 0)
                                            Averiado
                                        @elseif($m->estado == 1)
                                            En buen estado
                                        <!Este estado esta sujeto a cambios>
                                        @elseif($m->estado == 2)
                                            En mantenimiento
                                        @endif
                                    </td>
                                    <td>
                                        @unless($m->laboratorio == null)
                                            {{$m->lab->nombre}}
                                        @endunless
                                    </td>

                                    <!-- Botones de acción -->
                                    <th id="action_buttons">
                                        <button type="button"
                                            class="btn btn-primary m-t-15 waves-effect"
                                            onclick="edit('{{$m->_id}}');">

                                            <i class="material-icons">mode_edit</i>
                                        </button>
                                        <a href="/maquinaria/eliminar/{{$m->_id}}"
                                            class="btn btn-danger m-t-15 waves-effect">

                                            <i class="material-icons">delete</i>
                                        </a>
                                    </th>
                                    <!-- Fin de botones de acción -->

                                    <th id="edit_buttons" hidden>
                                        <button type="button"
                                            class="btn btn-primary m-t-15 waves-effect"
                                            onclick="edit('{{$m->_id}}');">

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
