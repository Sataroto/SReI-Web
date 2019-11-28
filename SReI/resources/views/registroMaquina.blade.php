@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop()
