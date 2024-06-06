@extends('layouts.master')
@section('title')
    Trabajadores por Areas
@endsection
@section('css')
   
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Reportes
        @endslot
        @slot('title')
            Trabajadores por Areas
        @endslot
    @endcomponent
    @livewire('rrhh.reportes.trabajadores-areas.table')
    @livewire('rrhh.reportes.trabajadores-areas.components.ver-detalles')
@endsection
@section('script')
@endsection
