<!--
    Versión 1.0
    Creado al 13/01/2020
    Modificao al 13/01/2020
    Editado por: mlopez
    Copyright SReI
-->

@extends('layouts.layout')

@section('content')
<!-- Contenedor del formulario -->
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
            <div class="card">
                <div class="body">
                    <!-- Inicio del formulario -->
                    {!!Form::open(array('url'=>'/mapeo-mesas/mapa',
                        'id'=>'add_mapm_form', 'method'=>'POST'))!!}
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">Mapa de mesas</h5>
                    </div>
             
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" border="0">
                        <tr >
                            
                            <th>A</th>
                            <th>B</th>
                          
                        </tr>
                        <tr>
                        
                            <th>A</th>
                            <th>B</th>
                            
                        </tr>
                        
                        </table>
                    </div>
                    <div class="">
                    <h6> Numero de mesas ocupadas:</h6>
                    </div>
                    <div class="">
                    <h6> Mesas usadas:</h6>
                    </div>
                    <div class="">
                    <h6> Tiempo total de uso:</h6>
                    </div>
                    {!!Form::close()!!}
                    <!-- Fin del formulario -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del contenedor del formulario -->
@stop()

@section('js')

@stop()
