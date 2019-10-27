<?php
    $array = [
        'opcion 1',
        'opcion 2',
        'opcion 3',
        'opcion 4',
    ];
?>
@extends('layouts.layout')

@section('title')

@stop()

@section('css')

@stop()

@section('popUp')
@stop()

@section('content')
    @if($sp == null)
        <label>no conectado</label>
    @else
        @foreach($sp as $s)
            <label>{{$s->nombre}}</label><br/>
        @endforeach
    @endif
@stop

@section('scripts')

@stop()
