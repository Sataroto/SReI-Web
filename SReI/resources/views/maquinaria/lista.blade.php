<!--
    Versión 1.1
    Creado al 17/12/2019
    Modificao al 09/08/2020
    Editado por: obelmonte
    Copyright SReI
-->

@extends('layouts.layout', ['api_errors' => $api_errors])

@section('css')
<!-- JQuery DataTable Css -->
<link href="{{asset('Template/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop

@section('popUp')
<!-- Modal de creacion -->
<div class="modal fade" id="maquinaria_form" tabindex="-1" role="dialog">
    <!-- Inicio del formulario de maquinaria -->
    {!!Form::open(array('url'=>'/maquinaria/nuevo', 'id'=>'add_maquina_form',
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
                        <div class="row clearfix">
                            <div class="col-xs-8">
                                <h5 class="modal-title">Nombre</h5>
                                <div class="form-group">
                                    <div class="form-line" id="bs_datepicker_container">
                                        {!!Form::text('nombre', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'nombre de la maquina',
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
                                            'placeholder'=>'Fabricante de la maquina',
                                            'id'=>'fabricante'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Modelo</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('modelo', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Modelo de la maquina',
                                            'id'=>'modelo'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Numero de serie</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('serie', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Numero de serie',
                                            'id'=>'serie'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Descipción</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::textarea('descripcion', null,
                                            ['class'=>'form-control',
                                            'id'=>'descripcion'])!!}
                                    </div>
                                </div>

                                <!--seccion de checklist-->
                                <h5 class="card-inside-title">Checklist</h5>
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
    <!-- Fin del formulario de maquinaria -->
</div>
<!-- Fin modal de creacion de maquinaria -->

<!--Modal de creacion de herramienta -->
<div class="modal fade" id="herramienta_form" tabindex="-1" role="dialog">
    <!-- Inicio del formulario de herramienta -->
    {!!Form::open(array('url'=>'/maquinaria/nuevo/herramienta', 'id'=>'add_herrameinta_form',
    'method'=>'POST'))!!}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Nueva herramienta</h5>
            </div>
            <div class="modal-body">
                <!-- Contenedor del formulario -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-8">
                                <h5 class="modal-title">Nombre</h5>
                                <div class="form-group">
                                    <div class="form-line" id="bs_datepicker_container">
                                        {!!Form::text('nombre', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'nombre de la maquina',
                                            'id'=>'nombre_her'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Laboratorio</h5>
                                <div class="form-group">
                                    <div class="form-line" id="ds_datepicker_container">
                                        {!!Form::select('laboratorio',
                                            $laboratorios, 0,
                                            ['class'=>'form-control',
                                            'id'=>'laboratorio_her'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Fabricante</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('fabricante', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Fabricante de la maquina',
                                            'id'=>'fabricante_her'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Modelo</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('modelo', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Modelo de la maquina',
                                            'id'=>'modelo_her'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Numero de serie</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('serie', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Numero de serie',
                                            'id'=>'serie_her'])!!}
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
    <!-- Fin del formulario de herramienta -->
</div>
<!-- Fin modal de creacion de herramienta -->

<!-- Modal informacion de maquinaria -->
<div class="modal fade" id="edit_modal_maquinaria" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="herramienta_modal_title">Información de la maquina</h5>
            </div>
            <div class="modal-body">
                {!!Form::open(array('url'=>'/maquinaria/edit', 'method'=>'patch'))!!}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-8">
                                {!!Form::hidden('_id_maquinaria',null,['id'=>'_id_maquinaria'])!!}

                                <h5 class="card-inside-title">Nombre</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_nombre_maquinaria', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Nombre de la maquina',
                                            'id'=>'edit_nombre_maquinaria'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Laboratorio</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::select('edit_laboratorio_maquinaria[]',
                                            $laboratorios, 0,
                                            ['class'=>'form-control',
                                            'id'=>'edit_laboratorio_maquinaria'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Fabricante</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_fabricante_maquinaria', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Fabricante de la maquina',
                                            'id'=>'edit_fabricante_maquinaria'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Modelo</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_modelo_maquinaria', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Modelo de la maquina',
                                            'id'=>'edit_modelo_maquinaria'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Numero de serie</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_serie_maquinaria', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Numero de serie',
                                            'id'=>'edit_serie_maquinaria'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Descipción</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::textarea('edit_descripcion_maquinaria', null,
                                            ['class'=>'form-control',
                                            'id'=>'edit_descripcion_maquinaria'])!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect"
                    onclick="habilitarEdicion('maquinaria');"
                    id="btn_editar_maquinaria">Editar</button>

                <button type="submit" class="btn btn-link waves-effect"
                    style="display:none;"
                    id="btn_enviar_maquinaria">Enviar</button>
                {!!Form::close()!!}

                <button type="button" class="btn btn-link waves-effect"
                    data-dismiss="modal"
                    id="btn_cerrar_maquinaria">Cerrar</button>

                <button type="button" class="btn btn-link waves-effect"
                    style="display:none;" onclick="cancelarEdicion('maquinaria');"
                    id="btn_cancelar_maquinaria">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal informacion de maquinaria -->

<!-- Modal informacion de herramienta -->
<div class="modal fade" id="edit_modal_herramienta" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="herramienta_modal_title">Información de la maquina</h5>
            </div>
            <div class="modal-body">
                {!!Form::open(array('url'=>'/maquinaria/edit', 'method'=>'patch'))!!}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-8">
                                {!!Form::hidden('_id_herramienta',null,['id'=>'_id_herramienta'])!!}

                                <h5 class="card-inside-title">Nombre</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_nombre_herramienta', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Nombre de la maquina',
                                            'id'=>'edit_nombre_herramienta'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Laboratorio</h5>
                                <div class="form-group">
                                    <div class="form-line">

                                        {!!Form::select('edit_laboratorio_herramienta',
                                        $laboratorios, 0,
                                        ['class'=>'form-control',
                                        'id'=>'edit_laboratorio_herramienta'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Fabricante</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_fabricante_herramienta', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Fabricante de la maquina',
                                            'id'=>'edit_fabricante_herramienta'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Modelo</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_modelo_herramienta', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Modelo de la maquina',
                                            'id'=>'edit_modelo_herramienta'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Numero de serie</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::text('edit_serie_herramienta', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Numero de serie',
                                            'id'=>'edit_serie_herramienta'])!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect"
                    onclick="habilitarEdicion('herramienta');"
                    id="btn_editar_herramienta">Editar</button>

                <button type="submit" class="btn btn-link waves-effect"
                    style="display:none;"
                    id="btn_enviar_herramienta">Enviar</button>
                {!!Form::close()!!}
                <button type="button" class="btn btn-link waves-effect"
                    data-dismiss="modal"
                    id="btn_cerrar_herramienta">Cerrar</button>

                <button type="button" class="btn btn-link waves-effect"
                    style="display:none;" onclick="cancelarEdicion('herramienta');"
                    id="btn_cancelar_herramienta">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal informacion de herramienta -->
@stop

@section('content')

@if($api_errors == 0)
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
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tab-nav-right" role="tablist">
                    <li role="presentation" class="active"><a href="#home" data-toggle="tab">MAQUINARIA</a></li>
                    <li role="presentation"><a href="#profile" data-toggle="tab">HERRAMIENTAS</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                        <!-- Inicio de la tabla de maquinaria-->
                        <div class="header">
                            <h5>
                                Maquinaria<br/>
                                <small>Lista de maquinaria en los laboratorios de pesados</small>
                            </h5>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <button type="button" class="btn btn-success waves-effect m-r-20"
                                    data-toggle="modal" data-target="#maquinaria_form">Nueva maquinaria</button>
                                </li>
                            </ul>

                        </div>
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
                                        @foreach($maquina as $m)
                                        <tr>
                                            <td>{{$m->_id}}</td>
                                            <td>{{$m->nombre}}</td>
                                            <td>
                                                @switch($m->estado)
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
                                                @if($m->disponible)
                                                    Disponible
                                                @else
                                                    Ocupado
                                                @endif
                                            </td>
                                            <td>{{$m->lab()->nombre}}</td>
                                            <td>
                                                <button type="button"
                                                        class="btn btn-success waves-effect m-r-20"
                                                        data-toggle="modal"
                                                        data-target="#edit_modal_maquinaria"
                                                        onclick="abrirModal({{$m}});"
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
                    <!-- Fin de la tabla de maquinaria -->

                    <!-- Inicio de la tabla de herramientas -->
                    <div role="tabpanel" class="tab-pane fade" id="profile">
                        <div class="header">
                            <h5>
                                Herramientas<br/>
                                <small>Lista de herramientas en los laboratorios de pesados</small>
                            </h5>
                            <ul class="header-dropdown m-r--5">
                                <li>
                                    <button type="button" class="btn btn-success waves-effect m-r-20"
                                    data-toggle="modal" data-target="#herramienta_form">Nueva herramienta</button>
                                </li>
                            </ul>

                        </div>
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
                                        @foreach($herramienta as $h)
                                        <tr>
                                            <td>{{$h->_id}}</td>
                                            <td>{{$h->nombre}}</td>
                                            <td>
                                                @switch($h->estado)
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
                                                @if($h->disponible)
                                                    Disponible
                                                @else
                                                    Ocupado
                                                @endif
                                            </td>
                                            <td>{{$h->lab()->nombre}}</td>
                                            <td>
                                                <button type="button" class="btn btn-success waves-effect m-r-20"
                                                data-toggle="modal" data-target="#edit_modal_herramienta" onclick="abrirModal({{$h}});">Edit</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Fin de la tabla de herramientas -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del contenedor de la lista -->
@endif()

@stop()

@section('js')
<!-- js del formulario de registro de maquinaria -->
<script src="{{asset('Template/custom-js/maquinariaForm.js')}}"></script>

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

<script>
    // Evita que el botón 'Enter' envie el formulario
    document.getElementById('add_maquina_form').addEventListener('keypress', function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });
</script>

@stop
