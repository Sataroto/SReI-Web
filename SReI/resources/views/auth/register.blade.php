@extends('layouts.loginLayout')

@section('content')
    <!-- Advanced Form Example With Validation -->
    <div class="body">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <!--p>Corrige los siguientes errores:</p-->
            <ul>
                @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {!!Form::open(['url'=>'/registrar','method'=>'POST','id'=>'wizard_with_validation'])!!}
            <h3>Datos de acceso</h3>
            <fieldset>
                <div class="form-group form-float">
                    <div class="form-line">
                        {!!Form::text('rfc',null,['class'=>'form-control','required','maxlength'=>'12','id'=>'rfc'])!!}
                        <label class="form-label">rfc*</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        {!!Form::password('password',['class'=>'form-control','required','id'=>'password'])!!}
                        <label class="form-label">Cotraseña*</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        {!!Form::password('password_confirmation',['class'=>'form-control','required','id'=>'password_confirmation'])!!}
                        <label class="form-label">Confirma la contraseña*</label>
                    </div>
                </div>
                <label>Comprobaremos su rfc con el SAES y su nombre será registrado automaticamente en el sistema</label>
            </fieldset>

            <h3>Información de trabajo</h3>
            <fieldset>
                <div class="form-group form-float">
                    Seleccione su ocupación
                    <div class="">
                        {!!Form::radio('tipo',1,false,['class'=>'with-gap radio-col-blue-grey','id'=>'radio_2', 'required'])!!}
                        <label for="radio_2">Docente</label>
                    </div>
                    <div class="">
                        {!!Form::radio('tipo',2,false,['class'=>'with-gap radio-col-blue-grey','id'=>'radio_1', 'required'])!!}
                        <label for="radio_1">Técnico</label>
                    </div>
                </div>

                <div class="form-group form-float">
                    Seleccione los edificios donde labora
                    <div class="">
                        {!!Form::radio('edificio','ligeros', false,['class'=>'with-gap radio-col-blue-grey','id'=>'ligeros','required'])!!}
                        <label for="ligeros">Ligeros</label>
                    </div>
                    <div class="">
                        {!!Form::radio('edificio','pesados', false,['class'=>'width-gap radio-col-blue-grey','id'=>'pesados','required'])!!}
                        <label for="pesados">Pesados</label>
                    </div>
                </div>
            </fieldset>
        {!!Form::close()!!}
    </div>
    <!-- #END# Advanced Form Example With Validation -->
@endsection
