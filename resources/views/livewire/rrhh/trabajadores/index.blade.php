@extends('layouts.master')
@section('title')
    Personal
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            RRHH
        @endslot
        @slot('title')
            Personal
        @endslot
    @endcomponent
    @livewire('rrhh.trabajadores.filtro')
    @livewire('rrhh.trabajadores.table')
    @livewire('rrhh.trabajadores.ver-detalles')
    
@endsection