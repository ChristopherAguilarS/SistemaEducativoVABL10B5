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
    @livewire('patrimonio.por-persona.components.nuevo-ingreso')
    @livewire('patrimonio.por-persona.filtro')
    @livewire('patrimonio.por-persona.table')
    @livewire('patrimonio.por-persona.components.ver-equipamiento')
    @livewire('patrimonio.por-persona.components.ver-comision')
@endsection
