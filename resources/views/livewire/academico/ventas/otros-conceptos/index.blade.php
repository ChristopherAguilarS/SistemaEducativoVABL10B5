@extends('layouts.master')
@section('title')
    Ventas - Otros Conceptos
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
            Ventas - Otros Conceptos
        @endslot
    @endcomponent
    @livewire('academico.ventas.otros-conceptos.filtro')
    @livewire('academico.ventas.otros-conceptos.table')
    @livewire('academico.ventas.otros-conceptos.ver-detalles')
@endsection
