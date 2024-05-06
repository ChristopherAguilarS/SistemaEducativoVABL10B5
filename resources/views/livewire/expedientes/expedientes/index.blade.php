@extends('layouts.master')
@section('title')
    Busqueda de Expedientes
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Expedientes
        @endslot
        @slot('title')
            Busqueda de Expedientes
        @endslot
    @endcomponent
    @livewire('expedientes.expedientes.filtro')
    @livewire('expedientes.expedientes.table')
    @livewire('expedientes.expedientes.components.ver-detalles')
@endsection
