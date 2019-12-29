@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    {!!Form::open(array('url'=>'/registroMaquina', 'id'=>'addMaquinaForm', 'method'=>'POST'))!!}
                    <div class="row clearfix">
                        <div class="col-xs-3">
                            <h2 class="card-inside-title">Nombre</h2>
                            <div class="form-group">
                                <div class="form-line" id="bs_datepicker_container">
                                    {!!Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'nombre de la maquina', 'id'=>'nombre'])!!}
                                </div>
                            </div>

                            <h2 class="card-inside-title">Laboratorio</h2>
                            <div class="form-group">
                                <div class="form-line" id="ds_datepicker_container">
                                    {!!Form::select('laboratorio', ['soldadura','otro'], 0, ['class'=>'form-control', 'id'=>'laboratorio'])!!}
                                </div>
                            </div>

                            <h2 class="card-inside-title">Fabricante</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('fabricante', null, ['class'=>'form-control', 'placeholder'=>'Fabricante de la maquina', 'id'=>'fabricante'])!!}
                                </div>
                            </div>

                            <h2 class="card-inside-title">Modelo</h2>
                            <div class="form-group">
                                <div class="form-line">
                                    {!!Form::text('modelo', null, ['class'=>'form-control', 'placeholder'=>'Modelo de la maquina', 'id'=>'modelo'])!!}
                                </div>
                            </div>

                            <!--seccion de checklist-->
                            <h2 class="card-inside-title">Checklist</h2>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="input-group spinner" data-trigger="spinner">
                                        <div class="form-line">
                                            {!!Form::text('nCheckList',1,['class'=>'form-control text-center', 'onchange'=>'updateCheklist();','data-rule'=>'quantity','id'=>'nCheckList'])!!}
                                        </div>

                                        <span class="input-group-addon">
                                            <a href="javascript:;" class="spin-up" data-spin="up" id="add"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                            <a href="javascript:;" class="spin-down" data-spin="down" id="rmv"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <table id="checkListTable">
                                <div id="checklistContainer">

                                </div>
                            </table>

                            <button type="submit" class="btn btn-primary waves-effect">Enviar</button>
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop()

@section('js')
<script src="{{asset('Template/custom-js/maquinariaForm.js')}}"></script>

<script>
    // Evita que el botón 'Enter' envie el formulario
    document.getElementById('addMaquinaForm').addEventListener('keypress', function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });
</script>
@stop()
