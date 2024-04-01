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
            Ventas - Matriculas
        @endslot
    @endcomponent
    @livewire('academico.ventas.matriculas.filtro')
    @livewire('academico.ventas.matriculas.table')
    @livewire('academico.ventas.matriculas.ver-detalles')
@endsection
