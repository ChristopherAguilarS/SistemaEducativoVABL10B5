@extends('layouts.master')
@section('title')
    Entrega - Recepción de Libros
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
            Entrega - Recepción de Libros
        @endslot
    @endcomponent
    @livewire('biblioteca.entrega-libros.filtro')
    @livewire('biblioteca.entrega-libros.table')
    @livewire('biblioteca.entrega-libros.components.ver-detalles')
    @livewire('biblioteca.entrega-libros.components.recepcion')
    @livewire('biblioteca.entrega-libros.components.entrega')
@endsection
