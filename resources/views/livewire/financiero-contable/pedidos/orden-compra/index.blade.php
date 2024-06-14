@extends('layouts.master')
@section('title')
    Orden de Compra
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modulo Financiero y Contable
        @endslot
        @slot('title')
            Orden de Compra
        @endslot
    @endcomponent
    @livewire('financiero-contable.pedidos.orden-compra.filtro')
    @livewire('financiero-contable.pedidos.orden-compra.table')
@endsection
@section('script')
<!--jquery cdn-->
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
