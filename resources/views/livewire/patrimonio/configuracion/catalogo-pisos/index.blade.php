@extends('layouts.master')
@section('title')
    Catalogo de Pisos de Ambientes
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Patrimonio
        @endslot
        @slot('title')
            Catalogo de Pisos de Ambientes
        @endslot
    @endcomponent
    @livewire('patrimonio.configuracion.catalogo-pisos.filtro')
    @livewire('patrimonio.configuracion.catalogo-pisos.table')
    @livewire('patrimonio.configuracion.catalogo-pisos.components.ver-detalles')
@endsection
