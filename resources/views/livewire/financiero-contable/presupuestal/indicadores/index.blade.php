@extends('layouts.master')
@section('title')
    Indicadores
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
            Indicadores
        @endslot
    @endcomponent
    @livewire('financiero-contable.presupuestal.indicadores.filtro')
    @livewire('financiero-contable.presupuestal.indicadores.table')
@endsection
@section('script')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

{{-- <script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script> --}}

{{-- <script src="{{ URL::asset('build/js/app.js') }}"></script>
<script defer>
    $('.js-example-basic-single').select2({
        placeholder: 'Seleccione una opcion',
        dropdownParent: '#myModal'
    })
</script> --}}
@endsection