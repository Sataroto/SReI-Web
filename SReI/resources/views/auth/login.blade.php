@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    {!!Form::open(['url'=>'/login/ejemplo','method'=>'post','id'=>'login'])!!}
                    <div class="form-group">
                        <label class="form-label">RFC</label>
                        {!!Form::text('rfc',null,['class'=>'form-control','id'=>'rfc'])!!}
                    </div>
                    <div class="form-group">
                        <label class="form-label">Contraseña</label>
                        {!!Form::password('pass',null,['class'=>'form-control','id'=>'pass'])!!}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="enviar">Enviar</button>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
