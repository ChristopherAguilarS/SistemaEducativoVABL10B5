@extends('layouts.master')
@section('title')
    Catalogo Categorías
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Biblioteca
        @endslot
        @slot('title')
            Catalogo Categorías
        @endslot
    @endcomponent
    @livewire('biblioteca.configuracion.catalogo-categorias.filtro')
    @livewire('biblioteca.configuracion.catalogo-categorias.table')
    @livewire('biblioteca.configuracion.catalogo-categorias.components.ver-detalles')
@endsection
