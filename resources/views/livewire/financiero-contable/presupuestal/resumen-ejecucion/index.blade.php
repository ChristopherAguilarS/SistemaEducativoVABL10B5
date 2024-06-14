@extends('layouts.master')
@section('title')
    Resumen de Ejecución
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Presupuestal
        @endslot
        @slot('title')
            Resumen de Ejecucion
        @endslot
    @endcomponent
    @livewire('financiero-contable.presupuestal.resumen-ejecucion.filtro')
    @livewire('financiero-contable.presupuestal.resumen-ejecucion.home')
@endsection
@section('script')

@endsection
