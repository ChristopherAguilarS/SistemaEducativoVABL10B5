@extends('layouts.master')
@section('title')
    Concepto de Ingreso
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Academico
        @endslot
        @slot('title')
            Concepto de Ingreso
        @endslot
    @endcomponent
    @livewire('academico.concepto-ingreso.filtro')
    @livewire('academico.concepto-ingreso.table')
@endsection
@section('script')
<!--jquery cdn-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script defer>
    $('.js-example-basic-single').select2({
        placeholder: 'Seleccione una opcion',
        dropdownParent: '#myModal'
    })
</script>
@endsection
