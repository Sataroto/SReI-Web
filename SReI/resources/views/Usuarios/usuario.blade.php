<!--
    Versión 1.0
    Creado al 12/09/2020
    Creado por: GBautista
    Modificao al 15/09/2020
    Editado por: GBautista
    Copyright SReI
-->
@extends('layouts.layout')

@section('css')
<!-- JQuery DataTable Css -->
<link href="{{asset('Template/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@stop

@section('popUp')
@stop

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-3">
            <div class="card profile-card">
                <div class="profile-header">&nbsp;</div>
                <div class="profile-body">
                    <div class="image-area">
                        <img src="{{asset('Template/images/user-lg.jpg')}}" 
                            alt="Foto de perfil" />
                    </div>
                    <div class="content-area">
                        <h3>Nombre de usuario</h3>
                        <p>Laboratorio/s</p>
                        <p>Tipo de usuario</p>
                    </div>
                </div>
                <div class="profile-footer">
                    <ul>
                        <li>
                            <span>Info</span>
                            <span>Example</span>
                        </li>
                    </ul>
                    </div>
            </div>

            
        </div>
        <div class="col-xs-12 col-sm-9">
            <div class="card">
                <div class="body">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Alumnos</a>
                            </li>
                            <li role="presentation">
                                <a href="#material" aria-controls="material" role="tab" 
                                    data-toggle="tab">Articulos Personales</a>
                            </li>
                            <li role="presentation">
                                <a href="#settings" aria-controls="settings" role="tab" 
                                    data-toggle="tab">Configuracion de usuario</a>
                            </li>
                            <li role="presentation">
                                <a href="#password" aria-controls="settings" role="tab" 
                                    data-toggle="tab">Cambio de contraseña</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                <div class="panel panel-default panel-post">
                                    <div class="panel-body">
                                        <div class="post">
                                            <div class="post-content">
                                                 <!-- Inicio de la tabla Alumnos-->
                                                <div class="header">
                                                    <h5>
                                                        Alumnos<br/>
                                                        <small>Lista de alumnos del usuario</small>
                                                    </h5>
                                                    <ul class="header-dropdown m-r--5">
                                                        <li>
                                                            <button type="button" class="btn btn-success waves-effect m-r-20"
                                                            data-toggle="modal" data-target="#update">Actualizar</button>
                                                        </li>
                                                    </ul>

                                                </div>
                                                <div class="body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Foto</th>
                                                                    <th>Nombre</th>
                                                                    <th>Boleta</th>
                                                                    <th>Carrera</th>
                                                                    <th>Vetado</th>
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Foto</th>
                                                                    <th>Nombre</th>
                                                                    <th>Boleta</th>
                                                                    <th>Carrera</th>
                                                                    <th>Vetado</th>
                                                                </tr>
                                                            </tfoot>
                                                            <tbody>
                                                                <tr>
                                                                    <td>#Foto</td>
                                                                    <td>Nombre alumno</td>
                                                                    <td>1234567891</td>
                                                                    <td>Sistemas Com.</td>
                                                                    <td>
                                                                    <div class="switch">
                                                                        <label><input type="checkbox"><span class="lever switch-col-blue-grey"></span></label>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>#Foto</td>
                                                                    <td>Nombre alumno</td>
                                                                    <td>1111111111</td>
                                                                    <td>Sistemas Com.</td>
                                                                    <td>
                                                                    <div class="switch">
                                                                        <label><input type="checkbox"><span class="lever switch-col-blue-grey"></span></label>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>#Foto</td>
                                                                    <td>Nombre alumno</td>
                                                                    <td>2222222222</td>
                                                                    <td>Mecatronica.</td>
                                                                    <td>
                                                                    <div class="switch">
                                                                        <label><input type="checkbox" checked><span class="lever switch-col-blue-grey"></span></label>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in fade" id="material">
                                <div class="panel panel-default panel-post">
                                    <div class="panel-body">
                                        <div class="post">
                                            <div class="post-content">
                                                 <!-- Inicio de materiales personales-->
                                                <div class="header">
                                                    <h5>
                                                        Material personal<br/>
                                                        <small>Lista de materiales del usuario</small>
                                                    </h5>
                                                    <ul class="header-dropdown m-r--5">
                                                        <li>
                                                            <button type="button" class="btn btn-success waves-effect m-r-20"
                                                            data-toggle="modal" data-target="#addMaterial">Agregar</button>
                                                        </li>
                                                    </ul>

                                                </div>
                                                <div class="body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Foto</th>
                                                                    <th>Nombre</th>
                                                                    <th>Codigo</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Foto</th>
                                                                    <th>Nombre</th>
                                                                    <th>Codigo</th>
                                                                    <th></th>
                                                                </tr>
                                                            </tfoot>
                                                            <tbody>
                                                                <tr>
                                                                    <td>#Foto</td>
                                                                    <td>material 1</td>
                                                                    <td>123456789</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-default btn-circle waves-effect waves-blue-grey waves-circle waves-float pull-right">
                                                                            <i class="material-icons">chrome_reader_mode</i>
                                                                        </button>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-default btn-circle waves-effect waves-blue-grey waves-circle waves-float pull-right">
                                                                            <i class="material-icons">delete</i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>#Foto</td>
                                                                    <td>material 1</td>
                                                                    <td>123456789</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-default btn-circle waves-effect waves-blue-grey waves-circle waves-float pull-right">
                                                                            <i class="material-icons">chrome_reader_mode</i>
                                                                        </button>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-default btn-circle waves-effect waves-blue-grey waves-circle waves-float pull-right">
                                                                            <i class="material-icons">delete</i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>#Foto</td>
                                                                    <td>material 1</td>
                                                                    <td>123456789</td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-default btn-circle waves-effect waves-blue-grey waves-circle waves-float pull-right">
                                                                            <i class="material-icons">chrome_reader_mode</i>
                                                                        </button>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-default btn-circle waves-effect waves-blue-grey waves-circle waves-float pull-right">
                                                                            <i class="material-icons">delete</i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div role="tabpanel" class="tab-pane fade in" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="NameSurname" class="col-sm-2 control-label">Name Surname</label>
                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="NameSurname" name="NameSurname" placeholder="Name Surname" value="Marc K. Hammond" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" value="example@example.com" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputExperience" class="col-sm-2 control-label">Experience</label>

                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <textarea class="form-control" id="InputExperience" name="InputExperience" rows="3" placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputSkills" class="col-sm-2 control-label">Skills</label>

                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="InputSkills" name="InputSkills" placeholder="Skills">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="checkbox" id="terms_condition_check" class="chk-col-red filled-in" />
                                            <label for="terms_condition_check">I agree to the <a href="#">terms and conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="password">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="Old Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="New Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="NewPasswordConfirm" name="NewPasswordConfirm" placeholder="New Password (Confirm)" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="btn btn-danger">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop()

@section('js')

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
