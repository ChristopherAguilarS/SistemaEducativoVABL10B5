@extends('layouts.master')
@section('title')
    Reporte de Equipos Según Situación
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
            Reporte de Equipos Según Situación
        @endslot
    @endcomponent
    @livewire('patrimonio.reportes.equipos-situacion.filtro')
    @livewire('patrimonio.reportes.equipos-situacion.table')
@endsection
