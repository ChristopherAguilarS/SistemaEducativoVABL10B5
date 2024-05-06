@extends('layouts.master')
@section('title')
    Patrimonio
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Patrimonio
        
        @endslot
        @slot('title')
            Inventariado
        @endslot
    @endcomponent
    @livewire('patrimonio.por-equipo.filtro')
    @livewire('patrimonio.por-equipo.table')
    @livewire('patrimonio.por-equipo.components.ver-equipamiento')
@endsection
