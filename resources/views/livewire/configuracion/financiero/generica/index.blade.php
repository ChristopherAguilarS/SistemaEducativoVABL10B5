@extends('layouts.master')
@section('title')
    Tipos de Transacciones
@endsection
@section('css')
   
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Finaciero
        @endslot
        @slot('title')
            Genericas
        @endslot
    @endcomponent
    @livewire('configuracion.financiero.generica.filtro')
    @livewire('configuracion.financiero.generica.table')
@endsection
@section('script')
@endsection

