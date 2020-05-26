@extends('layouts.loginLayout')

@section('content')
    <div class="body">
        {!!Form::open(array('url'=>'/login','method'=>'get','id'=>'sign_in'))!!}

        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">person</i>
            </span>
            <div class="form-line">
                {!!Form::text('rfc',null,['class'=>'form-control',
                'placeholder'=>'RFC','required',
                'aria-required'=>'true','maxlength'=>'12',
                'id'=>'rfc'])!!}
            </div>
        </div>

        <div class="input-group">
            <span class="input-group-addon">
                <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
                {!!Form::password('pass',['class'=>'form-control',
                'placeholder'=>'Contraseña','required',
                'aria-required'=>'true','maxlength'=>'10',
                'id'=>'pass'])!!}
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4">
            </div>
            <div class="col-xs-4">
                <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
            </div>
        </div>
        <div class="row m-t-15 m-b--20">
            <div class="col-xs-6">

            </div>
            <div class="col-xs-6 align-right">
                <a href="forgot-password.html">Forgot Password?</a>
            </div>
        </div>
        {!!Form::close()!!}
    </div>
@stop
