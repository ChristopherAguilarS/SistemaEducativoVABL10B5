@extends('layouts.master')
@section('title')
    Catalogo de Insumos
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Configuracion
        @endslot
        @slot('title')
            Catalogo de Insumos
        @endslot
    @endcomponent
    @livewire('financiero-contable.configuracion.catalogo-insumos.filtro')
    @livewire('financiero-contable.configuracion.catalogo-insumos.table')
    @livewire('financiero-contable.configuracion.catalogo-insumos.ver-detalles')
@endsection
