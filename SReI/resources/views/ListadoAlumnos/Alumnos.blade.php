<!--
    Versión 1.0
    Editado por: Rrios
    Copyright SReI
-->


<!-- Se hace un ARRAYLIST estatico con algunos usuarios -->
<?php
$usuarios=
array(
    array("Regina Dominique Ríos Ramírez","2017670452","Ing. Sistemas Computacionales", "Vetado"),
    array("Ane Isaksen","2017670032","Ing. Sistemas Computacionales", "Sin adeudos"),
    array("Joel B. Purcell","2017670210","Ing. Mecatrónica", "Sin adeudos"),
    array("Douglas Pinto Gomes","2016700092","Ing. Sistemas Computacionales", "En Observacion"),
    array("Diane Bordeleau","2018010991","Ing. Mecatrónica", "Normal"),
    array("Yolanda Kuznetsova","2020009128","Ing. Sistemas Computacionales", "Con 2 adeudos"),
    array("Oliver Johansson","2020500291","Ing. Mecatrónica", "Vetado"),
    array("Harry B. Moore","2017680034","Ing. Sistemas Computacionales", "Normal"),
    array("Henrietta Lomeli del Carmen","2018120930","Ing. Mecatrónica", "En Observacion"),
    array("Maglin Abarsha","2017900032","Ing. Ambiental", "Normal"),
    array("Emmi Sarparanta","2020890019","Ing. Sistemas Computacionales", "Con 3 adeudos"),
    array("Esther F. Bang","2016890027","Ing. Mecatrónica", "Vetado"),
    array("Frederik Lynge","2017670010","Ing. Sistemas Computacionales", "Vetado"),
    array("Carolina Nazarova","2016903782","Ing. Mecatrónica", "En Observacion"),
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
?>



@extends('layouts.layout')

@section('css')

@stop


@section('popUp')
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
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
              <?php
                $array = array("Nombre del alumno ","Boleta ","Carrera ","Estado");
                  foreach ($array as $valor) {
                    echo '<th>'.$valor.'</th>';
                  }
              ?>
          </tr>
      </thead>
              <!-- Fin de la cabecera de la tabla -->

          <!-- Cuerpo de la tabla -->
      <tbody>
          <?php
          // obtenemos los colores
          foreach ($usuarios as $array){
              echo "<tr>";
                  foreach($array as $contenido)
                  {
                      echo "<td>".$contenido."</td>";
                  }
              echo "</tr>";
          }
          ?>
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
@stop
