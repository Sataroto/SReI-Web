<!--
    Versión 1.0
    Creado al 14/01/2020
    Modificao al 24/09/2020
    Editado por: obelmonte
    Copyright SReI
-->
@extends('layouts.layout')

@section('css')
<!-- JQuery DataTable Css -->
<link href="{{asset('Template/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop

@section('popUp')
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <!-- Inicio del formulario -->
    {!!Form::open(array('url'=>'/tarjetas-programables/nuevo', 'id'=>'add_tp_form',
    'method'=>'POST'))!!}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Modal title</h5>
            </div>
            <div class="modal-body">
                <!-- Contenedor del formulario -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="body">
                        <!-- Inicio del formulario -->
                        <div class="row clearfix">
                            <div class="col-xs-8">
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

                            </div>
                        </div>
                        <!-- Fin del formulario -->
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

<div class="modal fade" id="edit_equipo" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Información del equipo</h5>
            </div>
            <div class="modal-bod">
                {!!Form::open(array('url'=>'', 'method'=>'patch'))!!}
                <div class="col-lg12 col-md-12 col-sm-12 col-xs-12">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-8">
                                {!!Form::hidden('_id_tarjeta',null,['id'=>'_id_tarjeta'])!!}

                                <h5 class="card-inside-title">Nombre</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_nombre_tarjeta', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Nombre del equipo',
                                            'id'=>'edit_nombre_tarjeta'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Laboratorio</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::select('edit_laboratorio_tarjeta[]',
                                            $laboratorios, 0,
                                            ['class'=>'form-control',
                                            'id'=>'edit_laboratorio_tarjeta'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Fabricante</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_fabricante_tarjeta', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Fabricante del equipo',
                                            'id'=>'edit_fabricante_tarjeta'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Modelo</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_modelo_tarjeta', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Modelo del equipo',
                                            'id'=>'edit_modelo_tarjeta'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Numero de serie</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_serie_tarjeta', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Numero de serie',
                                            'id'=>'edit_serie_tarjeta'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Estado</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::radio('edit_estado_tarjeta',
                                            0, false,
                                            ['class'=>'radio-col-blue edit_estado_tarjeta',
                                            'id'=>'edit_estado_tarjeta_0'])!!}
                                        <label for="edit_estado_tarjeta_0">Aberiado</label>
                                        <br/>

                                        {!!Form::radio('edit_estado_tarjeta',
                                            1, false,
                                            ['class'=>'radio-col-blue edit_estado_tarjeta',
                                            'id'=>'edit_estado_tarjeta_1'])!!}
                                        <label for="edit_estado_tarjeta_1">Funcionando</label>
                                        <br/>

                                        {!!Form::radio('edit_estado_tarjeta',
                                            2, false,
                                            ['class'=>'radio-col-blue edit_estado_tarjeta',
                                            'id'=>'edit_estado_tarjeta_2'])!!}
                                        <label for="edit_estado_tarjeta_2">Mantenimiento</label>
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Descipción</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::textarea('edit_descripcion_tarjeta', null,
                                            ['class'=>'form-control',
                                            'id'=>'edit_descripcion_tarjeta'])!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect"
                    onclick="habilitarEdicion('tarjeta');"
                    id="btn_editar_tarjeta">Editar</button>

                <button type="submit" class="btn btn-link waves-effect"
                    style="display:none;"
                    id="btn_enviar_tarjeta">Enviar</button>
                {!!Form::close()!!}

                <button type="button" class="btn btn-link waves-effect"
                    data-dismiss="modal"
                    id="btn_cerrar_tarjeta">Cerrar</button>

                <button type="button" class="btn btn-link waves-effect"
                    style="display:none;" onclick="cancelarEdicion('tarjeta');"
                    id="btn_cancelar_tarjeta">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')
<!-- Contenedor de la lista -->
<div class="row clearfix">
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
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Tarjetas Programables
                    <small>Lista de tarjetas programables en los laboratorios de ligeros</small>
                    <ul class="header-dropdown m-r--5">
                        <button type="button" class="btn btn-success waves-effect m-r-20"
                        data-toggle="modal" data-target="#defaultModal">Nuevo</button>
                    </ul>
                </h2>
            </div>
            <!-- Inicio de la tabla -->
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Disponibilidad</th>
                                <th>Laboratorio</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Disponibilidad</th>
                                <th>Laboratorio</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($tarjeta as $t)
                                <tr>
                                    <td>{{$t->_id}}</td>
                                    <td>{{$t->nombre}}</td>
                                    <td>
                                        @switch($t->estado)
                                            @case(0)
                                                Aberiado
                                                @break
                                            @case(1)
                                                Funcionando
                                                @break
                                            @case(2)
                                                Mantenimiento
                                                $break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($t->disponible)
                                            Disponioble
                                        @else
                                            Ocupado
                                        @endif
                                    </td>
                                    <td>{{$t->lab->nombre}}</td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-success waves-effect m-r-20"
                                                data-toggle="modal"
                                                data-target="#edit_equipo"
                                                onclick="abrirModal({{$t}});"
                                        >
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del contenedor de la lista -->
@stop()

@section('js')
<script src="{{asset('Template/custom-js/editButtons.js')}}"></script>
<script src="{{asset('Template/custom-js/editTarjeta.js')}}"></script>

<!-- js para la edición de la información dl equipo -->
<script src="{{asset('Template/custom-js/editEquipo.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('Template/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('Template/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('Template/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('Template/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('Template/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('Template/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('Template/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('Template/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('Template/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
<script src="{{asset('Template/js/pages/tables/jquery-datatable.js')}}"></script>
@stop
