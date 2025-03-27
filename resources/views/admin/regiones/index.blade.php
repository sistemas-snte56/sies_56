@extends('adminlte::page')

@section('title', 'Regiones')

@section('content_header')
    <h1>Regiones</h1>
@stop

@section('content')
    @livewire('regiones-page')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop
