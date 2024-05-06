@extends('layouts.master')
@section('title')
    Catalogo de Áreas
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Recursos Humanos
        @endslot
        @slot('title')
            Catalogo de Áreas
        @endslot
    @endcomponent
    @livewire('rrhh.configuracion.catalogo-areas.filtro')
    @livewire('rrhh.configuracion.catalogo-areas.table')
    @livewire('rrhh.configuracion.catalogo-areas.components.ver-detalles')
@endsection
