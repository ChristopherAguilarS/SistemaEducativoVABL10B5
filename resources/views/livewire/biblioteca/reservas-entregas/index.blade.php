@extends('layouts.master')
@section('title')
    Reservas - Entregas de Libros
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
            Reservas - Entregas de Libros
        @endslot
    @endcomponent
    @livewire('biblioteca.reservas-entregas.filtro')
    @livewire('biblioteca.reservas-entregas.table')
    @livewire('biblioteca.reservas-entregas.components.ver-detalles')
    @livewire('biblioteca.reservas-entregas.components.devolver')
@endsection
