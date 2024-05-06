@extends('layouts.master')
@section('title')
    Configuracion de Familias
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
            Configuracion de Familias
        @endslot
    @endcomponent
    @livewire('patrimonio.configuracion.familias.filtro')
    @livewire('patrimonio.configuracion.familias.table')
    @livewire('patrimonio.configuracion.familias.components.ver-detalles')
@endsection
