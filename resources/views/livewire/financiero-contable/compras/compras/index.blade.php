@extends('layouts.master')
@section('title')
    Compras
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Compras
        @endslot
        @slot('title')
            Compras
        @endslot
    @endcomponent
    @livewire('financiero-contable.compras.compras.filtro')
    @livewire('financiero-contable.compras.compras.table')
    @livewire('financiero-contable.compras.compras.ver-detalles')
    @livewire('financiero-contable.compras.compras.components.ver-recurso')
    @livewire('financiero-contable.compras.compras.editar-item')
@endsection
