@extends('layouts.master')
@section('title')
    Carrera / Especialidad
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
            Plan Academico
        @endslot
    @endcomponent
    @livewire('academico.administracion.plan-academico.filtro')
    @livewire('academico.administracion.plan-academico.table')
    @livewire('academico.administracion.plan-academico.ver-detalles')
@endsection
