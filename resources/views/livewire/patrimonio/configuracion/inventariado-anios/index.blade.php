@extends('layouts.master')
@section('title')
    Configuracion
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            RRHH
        @endslot
        @slot('title')
            Configuracion de Horarios
        @endslot
    @endcomponent
    @livewire('patrimonio.configuracion.inventariado-anios.filtro')
    @livewire('patrimonio.configuracion.inventariado-anios.table')
    @livewire('patrimonio.configuracion.inventariado-anios.components.ver-detalles')
@endsection
