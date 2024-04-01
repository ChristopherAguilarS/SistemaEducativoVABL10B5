@extends('layouts.master')
@section('title')
    Programacion Mensual
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
            Programacion Mensual
        @endslot
    @endcomponent
    @livewire('rrhh.horarios.programacion-mensual.filtro')
    @livewire('rrhh.horarios.programacion-mensual.table')
    @livewire('rrhh.horarios.programacion-mensual.ver-detalles')
@endsection
