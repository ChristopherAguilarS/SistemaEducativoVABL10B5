@extends('layouts.master')
@section('title')
    Roles
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Configuracion
        @endslot
        @slot('title')
            Roles
        @endslot
    @endcomponent
    @livewire('configuracion.roles.filtro')
    @livewire('configuracion.roles.table')
    @livewire('configuracion.roles.components.ver-detalles')
    @livewire('configuracion.roles.components.ver-menus')
@endsection
