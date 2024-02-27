@extends('layouts.master')
@section('title')
    Semestres Academicos
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
            Semestres
        @endslot
    @endcomponent
    @livewire('academico.administracion.semestres.filtro')
    @livewire('academico.administracion.semestres.table')
    @livewire('academico.administracion.semestres.ver-detalles')
@endsection
