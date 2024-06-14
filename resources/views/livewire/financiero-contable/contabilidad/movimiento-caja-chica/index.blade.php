@extends('layouts.master')
@section('title')
    Caja Chica
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
            Caja Chica
        @endslot
    @endcomponent
    @livewire('financiero-contable.contabilidad.movimiento-caja-chica.filtro')
    @livewire('financiero-contable.contabilidad.movimiento-caja-chica.table')
@endsection
@section('script')

@endsection
