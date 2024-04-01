@extends('layouts.master')
@section('title')
    Ventas - Matriculas
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
            Ventas - Mensualidades
        @endslot
    @endcomponent
    @livewire('academico.ventas.mensualidades.filtro')
    @livewire('academico.ventas.mensualidades.table')
    @livewire('academico.ventas.mensualidades.ver-detalles')
@endsection
