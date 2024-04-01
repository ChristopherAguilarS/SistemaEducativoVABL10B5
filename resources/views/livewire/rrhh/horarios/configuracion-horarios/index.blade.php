@extends('layouts.master')
@section('title')
    Configuracion de Horarios
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
    @livewire('rrhh.horarios.configuracion-horarios.filtro')
    @livewire('rrhh.horarios.configuracion-horarios.table')
    @livewire('rrhh.horarios.configuracion-horarios.ver-detalles')
@endsection
