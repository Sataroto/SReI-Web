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
                            <th>Nombre de la maquina</th>
                            <th>Código</th>
                            <th>Fabricante</th>
                            <th>Modelo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Fin de la cabecera de la tabla -->

                    <!-- Cuerpo de la tabla -->
                    <tbody>
                        @unless($maquina == null)
                            @foreach($maquina as $m)
                                <tr>
                                    <th scope="row">{{$m->nombre}}</th>
                                    <td>some code</td>
                                    <td>{{$m->caracteristicas[0]}}</td>
                                    <td>{{$m->caracteristicas[1]}}</td>
                                    <td>
                                        @if($m->estado == 0)
                                            Disponible
                                        @elseif($m->estado == 1)
                                            Ocupado
                                        @elseif($m->estado == 2)<!Este estado esta sujeto a cambios>
                                            En mantenimiento
                                        @elseif($m->estado == 3)
                                            Averiado
                                        @endif
                                    </td>

                                    <!-- Botones de acción -->
                                    <td>
                                        <button type="button"
                                            class="btn btn-primary m-t-15 waves-effect">

                                            <i class="material-icons">mode_edit</i>
                                        </button>
                                        <button type="button"
                                            class="btn btn-danger m-t-15 waves-effect">

                                            <i class="material-icons">delete</i>
                                        </button>
                                    </td>

                                    <!-- Fin de botones de acción -->
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
