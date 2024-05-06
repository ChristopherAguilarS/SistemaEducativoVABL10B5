@extends('layouts.master')
@section('title')
    Prestamos de Equipos
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
            Prestamos de Equipos
        @endslot
    @endcomponent
    @livewire('mesa-partes.registro-documento.filtro')
@endsection
