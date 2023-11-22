@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{--@component('components.navbar')
    @endcomponent--}}
@stop

@section('content')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @vite([
       'resources/sass/app.scss',
       'resources/fontawesome/css/all.min.css',
       'resources/js/app.js',
       'resources/js/jquery-3.7.1.js',
       /*'resources/js/jquery-ui.js',*/
       'resources/css/app.css',
       'resources/css/navbar.css',
       'resources/css/bg-striped.css',
       'resources/css/cart.css',
       'resources/js/quantity-input-handler.js',
       'resources/js/bootstrap.js'
       ])
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
