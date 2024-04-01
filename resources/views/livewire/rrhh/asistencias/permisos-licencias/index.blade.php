@extends('layouts.master')
@section('title')
    Permisos y Licencias
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
            Permisos y Licencias
        @endslot
    @endcomponent
    @livewire('rrhh.asistencias.permisos-licencias.filtro')
    @livewire('rrhh.asistencias.permisos-licencias.table')
    @livewire('rrhh.asistencias.permisos-licencias.components.nuevo-vacaciones')
    @livewire('rrhh.asistencias.permisos-licencias.components.nuevo-permisos')
    @livewire('rrhh.asistencias.permisos-licencias.components.nuevo-licencias')
    @livewire('rrhh.asistencias.permisos-licencias.components.nuevo-comisiones')
    @livewire('rrhh.asistencias.permisos-licencias.components.resumen')
    <script>
                function calcDias(){
                    var date_1 = new Date($('#finicio').val()); 
                    var date_2 = new Date($('#ffin').val());

                    var day_as_milliseconds = 86400000;
                    var diff_in_millisenconds = date_2 - date_1;
                    var diff_in_days = diff_in_millisenconds / day_as_milliseconds;
                    $('#diff').val(diff_in_days+1);
                }
            </script>
@endsection
