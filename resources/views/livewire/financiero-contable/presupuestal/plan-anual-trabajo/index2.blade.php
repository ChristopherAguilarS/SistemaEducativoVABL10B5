@extends('layouts.master')
@section('title')
    Presupuestal
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Plan Anual de Trabajo
        @endslot
        @slot('title')
        Plan Anual de Trabajo
        @endslot
    @endcomponent
    @livewire('financiero-contable.presupuestal.plan-anual-trabajo.filtro')
    @livewire('financiero-contable.presupuestal.plan-anual-trabajo.table2')
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endsection
