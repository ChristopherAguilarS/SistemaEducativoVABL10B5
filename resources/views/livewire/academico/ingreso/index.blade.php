@extends('layouts.master')
@section('title')
    Otros Ingresos
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
            Otros Ingresos
        @endslot
    @endcomponent
    @livewire('academico.ingreso.filtro')
    @livewire('academico.ingreso.table')
@endsection
@section('script')
@endsection
