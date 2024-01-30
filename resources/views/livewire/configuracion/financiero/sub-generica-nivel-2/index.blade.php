@extends('layouts.master')
@section('title')
    Sub Genericas Nivel 2
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">  
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Finaciero
        @endslot
        @slot('title')
        Sub Genericas Nivel 2
        @endslot
    @endcomponent
    @livewire('configuracion.financiero.sub-generica-nivel-2.filtro')
    @livewire('configuracion.financiero.sub-generica-nivel-2.table')
@endsection
@section('script')
<!--jquery cdn-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!--Toastify-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endsection
