@extends('layouts.master')
@section('title')
    Tipos de Transacciones
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Finaciero
        @endslot
        @slot('title')
            Tipos de Transacciones
        @endslot
    @endcomponent
    @livewire('configuracion.financiero.tipo-transaccion.filtro')
    @livewire('configuracion.financiero.tipo-transaccion.table')
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endsection
