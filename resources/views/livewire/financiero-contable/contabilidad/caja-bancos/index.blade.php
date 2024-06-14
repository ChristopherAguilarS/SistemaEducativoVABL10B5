@extends('layouts.master')
@section('title')
    Caja y Bancos
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
            Caja y Bancos
        @endslot
    @endcomponent
    @livewire('financiero-contable.contabilidad.caja-bancos.filtro')
    @livewire('financiero-contable.contabilidad.caja-bancos.table')
@endsection
@section('script')
<!--jquery cdn-->

@endsection
