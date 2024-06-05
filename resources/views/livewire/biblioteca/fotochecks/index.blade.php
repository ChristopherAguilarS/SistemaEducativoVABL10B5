@extends('layouts.master')
@section('title')
Carné de Biblioteca
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Biblioteca
        @endslot
        @slot('title')
        Carné de Biblioteca
        @endslot
    @endcomponent
    @livewire('biblioteca.fotochecks.filtro')
    @livewire('biblioteca.fotochecks.table')
    @livewire('biblioteca.fotochecks.components.resumen')
    @livewire('biblioteca.fotochecks.components.nuevo')
@endsection
