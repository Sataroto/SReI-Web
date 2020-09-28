<!--
    Versión 1.4
    Creado al 15/01/2020
    Creado por: GBautista
    Modificado al: 24/09/2020
    Editado por: GBautista
    Copyright SReI
-->

@extends('layouts.layout', ['api_errors' => $api_errors])

@section('css')
<!-- JQuery DataTable Css -->
<link href="{{asset('Template/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop


@section('popUp')
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <!-- Inicio del formulario -->
    {!!Form::open(array('url'=>'/equipoElectronica/nuevo',
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
                                            'placeholder'=>'Nombre del equipo',
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

                                <h5 class="card-inside-title">Número de serie</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('serie', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Serie de equipo',
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
                                {!!Form::hidden('_id_electronica',null,['id'=>'_id_electronica'])!!}

                                <h5 class="card-inside-title">Nombre</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_nombre_electronica', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Nombre del equipo',
                                            'id'=>'edit_nombre_electronica'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Laboratorio</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::select('edit_laboratorio_electronica[]',
                                            $laboratorios, 0,
                                            ['class'=>'form-control',
                                            'id'=>'edit_laboratorio_electronica'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Fabricante</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_fabricante_electronica', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Fabricante del equipo',
                                            'id'=>'edit_fabricante_electronica'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Modelo</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_modelo_electronica', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Modelo del equipo',
                                            'id'=>'edit_modelo_electronica'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Numero de serie</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_serie_electronica', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Numero de serie',
                                            'id'=>'edit_serie_electronica'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Estado</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::radio('edit_estado_electronica',
                                            0, false,
                                            ['class'=>'radio-col-blue edit_estado_electronica',
                                            'id'=>'edit_estado_electronica_0'])!!}
                                        <label for="edit_estado_electronica_0">Aberiado</label>
                                        <br/>

                                        {!!Form::radio('edit_estado_electronica',
                                            1, false,
                                            ['class'=>'radio-col-blue edit_estado_electronica',
                                            'id'=>'edit_estado_electronica_1'])!!}
                                        <label for="edit_estado_electronica_1">Funcionando</label>
                                        <br/>

                                        {!!Form::radio('edit_estado_electronica',
                                            2, false,
                                            ['class'=>'radio-col-blue edit_estado_electronica',
                                            'id'=>'edit_estado_electronica_2'])!!}
                                        <label for="edit_estado_electronica_2">Mantenimiento</label>
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Descipción</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::textarea('edit_descripcion_electronica', null,
                                            ['class'=>'form-control',
                                            'id'=>'edit_descripcion_electronica'])!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect"
                    onclick="habilitarEdicion('electronica');"
                    id="btn_editar_electronica">Editar</button>

                <button type="submit" class="btn btn-link waves-effect"
                    style="display:none;"
                    id="btn_enviar_electronica">Enviar</button>
                {!!Form::close()!!}

                <button type="button" class="btn btn-link waves-effect"
                    data-dismiss="modal"
                    id="btn_cerrar_electronica">Cerrar</button>

                <button type="button" class="btn btn-link waves-effect"
                    style="display:none;" onclick="cancelarEdicion('electronica');"
                    id="btn_cancelar_electronica">Cancelar</button>
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
            <div class="body">
                <div class="header">
                    <h2>
                        Electrónica
                        <small>Lista de equipo en los laboratorios de ligeros</small>
                        <ul class="header-dropdown m-r--5">
                            <button type="button" class="btn btn-success waves-effect m-r-20"
                            data-toggle="modal" data-target="#defaultModal">Nuevo</button>
                        </ul>
                    </h2>
                </div>
                <!-- Inicio de la tabla de électronica -->
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
                                @foreach($equipoElectronica as $e)
                                    <tr>
                                        <td>{{$e->_id}}</td>
                                        <td>{{$e->nombre}}</td>
                                        <td>
                                            @switch($e->estado)
                                                @case(0)
                                                    Aberiado
                                                    @break
                                                @case(1)
                                                    Funcionando
                                                    @break
                                                @case(2)
                                                    Mantenimiento
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            @if($e->disponible)
                                                Disponioble
                                            @else
                                                Ocupado
                                            @endif
                                        </td>
                                        <td>{{$e->lab()->nombre}}</td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-success waves-effect 
                                                        m-r-10 m-b-10"
                                                    data-toggle="modal"
                                                    data-target="#edit_equipo"
                                                    onclick="abrirModal({{$e}});"
                                            >
                                                <i class="material-icons">visibility</i>
                                            </button>
                                            {!!Form::open(
                                                array('url'=>'/equipoElectronica/eliminar/'.$e->_id,
                                                'method'=>'delete'
                                            ))!!}
                                            <button type="submit"
                                                class="btn btn-danger waves-effect m-r-0 m-b-10"
                                            >
                                                <i class="material-icons">delete</i>
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
</div>
<!-- Fin del contenedor de la lista -->
@stop()

@section('js')
<script src="{{asset('Template/custom-js/editTarjeta.js')}}"></script>
<script src="{{asset('Template/custom-js/editButtons.js')}}"></script>

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
