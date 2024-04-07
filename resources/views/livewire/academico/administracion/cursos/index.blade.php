@extends('layouts.master')
@section('title')
    Cursos
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
            Cursos
        @endslot
    @endcomponent
    @livewire('academico.administracion.cursos.filtro')
    @livewire('academico.administracion.cursos.table')
    @livewire('academico.administracion.cursos.ver-detalles')
@endsection