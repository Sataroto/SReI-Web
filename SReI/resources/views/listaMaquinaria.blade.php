@extends('layouts.layout')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Maquinaria
                    <small>Lista de maquinaria en los laboratorios de pesados</small>
                </h2>
            </div>
            <div class="body table-responsive">
                <table class="table">
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
                                    <td>
                                        <button type="button" class="btn btn-primary m-t-15 waves-effect">
                                            <i class="material-icons">mode_edit</i>
                                        </button>
                                        <button type="button" class="btn btn-danger m-t-15 waves-effect">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endunless
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop()
