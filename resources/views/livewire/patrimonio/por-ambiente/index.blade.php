@extends('layouts.master')
@section('title')
    Inventariado por Ambiente
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
            Inventariado por Ambiente
        @endslot
    @endcomponent
    @livewire('patrimonio.por-ambiente.components.nuevo-ingreso')
    @livewire('patrimonio.por-ambiente.filtro')
    @livewire('patrimonio.por-ambiente.table')
    @livewire('patrimonio.por-ambiente.components.ver-equipamiento')
    @livewire('patrimonio.por-ambiente.components.ver-comision')
    @livewire('patrimonio.por-ambiente.components.inventariar')
@endsection
