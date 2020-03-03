<!--
    Versión 1.0
    Editado por: Rrios
    Copyright SReI
-->


<!-- Se ha hecho un ARRAYLIST estatico con algunos usuarios -->
<?php
$usuarios=
array(
    array('Regina Dominique Ríos Ramírez','2017670452','Ing. Sistemas Computacionales', 'Vetado'),
    array('Ane Isaksen','2017670032','Ing. Sistemas Computacionales', 'Sin adeudos'),
    array('Joel B. Purcell','2017670210','Ing. Mecatrónica', 'Sin adeudos'),
    array('Douglas Pinto Gomes','2016700092','Ing. Sistemas Computacionales', 'En Observacion'),
    array('Diane Bordeleau','2018010991','Ing. Mecatrónica', 'Normal'),
    array('Yolanda Kuznetsova','2020009128','Ing. Sistemas Computacionales', 'Con 2 adeudos'),
    array('Oliver Johansson','2020500291','Ing. Mecatrónica', 'Vetado'),
    array('Harry B. Moore','2017680034','Ing. Sistemas Computacionales', 'Normal'),
    array('Henrietta Lomeli del Carmen','2018120930','Ing. Mecatrónica', 'En Observacion'),
    array('Maglin Abarsha','2017900032','Ing. Ambiental', 'Normal'),
    array('Emmi Sarparanta','2020890019','Ing. Sistemas Computacionales', 'Con 3 adeudos'),
    array('Esther F. Bang','2016890027','Ing. Mecatrónica', 'Vetado'),
    array('Frederik Lynge','2017670010','Ing. Sistemas Computacionales', 'Vetado'),
    array('Carolina Nazarova','2016903782','Ing. Mecatrónica', 'En Observacion'),
);

$Miarray=array();
foreach ($usuarios as $array){
    if($array[3])
    {
        $Miarray[$array[2]]=$array[3];
    }
}

for($i=0;$i<count($usuarios);$i++){
    if($usuarios[$i][3]=="" && array_key_exists($usuarios[$i][2], $Miarray))
    {
        $usuarios[$i][3]=$colores[$usuarios[$i][2]];
    }
}

$array = array("Nombre del alumno ","Boleta ","Carrera ","Estado","Accion");
?>
<!--Este array list se hizo para rellenar la tabla con los campos de "Nombre", "Boleta", "Carrera", "Estado", "Acción" -->


@extends('layouts.layout')

@section('css')
<link href="css/switchery.css" rel="stylesheet"/>
<script src="css/switchery.js"></script>
@stop


@section('popUp')
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <!-- Inicio del formulario -->
    {!!Form::open(array('url'=>'/',
        'id'=>'addUser', 'method'=>'POST'))!!}
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
                              <!-- Aqui deje mi nombre estatico, asi que al dar en modificar, pues aparecerá siempre REGINA -->
                                <h5 class="card-inside-title">Regina Dominique Rios Ramirez</h5>
                                <h5 class="card-inside-title">Observaciones</h5>
                                <div class="form-group">
                                    <div class="form-line">
                                        {!!Form::textarea('Observacion', null,
                                            ['class'=>'form-control',
                                            'placeholder'=>'Observaciones del alumno',
                                            'id'=>'ob'])!!}
                                    </div>
                                </div>

                                <h5 class="card-inside-title">Vetado</h5>
                                <div class="form-group">
                                  <div class="demo-switch">
                              <div class="switch">
                                  <label>OFF<input type="checkbox" checked=""><span class="lever"></span>ON</label>
                              </div>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin del contenedor del formulario -->

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-link waves-effect">Actualizar</button> <!--Aqui no manda a ningun lado-->
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
                    Listado de Alumnos
                    <small>Lista de los alumnos</small>
                </h2>
            </div>
            <!-- Inicio de la tabla -->
            <div class="body table-responsive">
                    <table class="table">
          <!--Cabecera de la tabla -->
      <thead>
          <tr>
            @foreach($array as $valor)
                <th>{{$valor}}</th>
            @endforeach
          </tr>
      </thead>
              <!-- Fin de la cabecera de la tabla -->

          <!-- Cuerpo de la tabla -->
      <tbody>
        @foreach($usuarios as $array)
            <tr>
              @foreach($array as $contenido)

                  <td>{{$contenido}}</td>
              @endforeach
              <td>
                <button type="button" class="btn btn-success waves-effect m-r-20"
                data-toggle="modal" data-target="#defaultModal">Modificar</button>
              <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                </div>
              </td>
            </tr>
        @endforeach
      </tbody>
       <!-- Fin del cuerpo de la tabla -->
  </table>
     <!-- Fin de la tabla -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del contenedor de la lista -->
@stop()

@section('js')
<script src="{{asset('Template/custom-js/editTarjeta.js')}}"></script>
<script src="{{asset('Template/custom-js/editButtons.js')}}"></script>
<script src="{{asset('Template/custom-js/switchery.js')}}"></script>
<script>
  var elem = document.querySelector('.js-switch');
  var init = new Switchery(elem);
</script>
@stop
