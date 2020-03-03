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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Fin de la cabecera de la tabla -->

                    <!-- Cuerpo de la tabla -->
                    <tbody>
                      @unless($personal == null)
                          @foreach($personal as $m)
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
                                  @unless(sizeof($m->caracteristicas) == 0)
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
                                  @endunless
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

                                  <!-- Botones de acción -->
                                  <th id="action_buttons">
                                      <button type="button"
                                          class="btn btn-primary m-t-6 waves-effect"
                                          onclick="edit('{{$m->_id}}');">

                                          <i class="material-icons">mode_edit</i>
                                      </button><br/>
                                      <button type="button"
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
                                      </button><br/>
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
<script src="{{asset('Template/custom-js/editTarjeta.js')}}"></script>
<script src="{{asset('Template/custom-js/editButtons.js')}}"></script>
@stop
