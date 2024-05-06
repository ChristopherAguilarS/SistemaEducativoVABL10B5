@extends('layouts.master')
@section('title')
    Catalogo Tipo de Documento
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Mesa de Partes
        @endslot
        @slot('title')
            Catalogo Tipo de Documento
        @endslot
    @endcomponent
    @livewire('mesa-partes.configuracion.catalogo-tipo-documento.filtro')
    @livewire('mesa-partes.configuracion.catalogo-tipo-documento.table')
    @livewire('mesa-partes.configuracion.catalogo-tipo-documento.components.ver-detalles')
@endsection
