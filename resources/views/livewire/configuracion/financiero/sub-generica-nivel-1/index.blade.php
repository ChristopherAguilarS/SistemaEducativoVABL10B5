@extends('layouts.master')
@section('title')
    Sub Genericas Nivel 1
@endsection
@section('css')
   
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Finaciero
        @endslot
        @slot('title')
        Sub Genericas Nivel 1
        @endslot
    @endcomponent
    @livewire('configuracion.financiero.sub-generica-nivel-1.filtro')
    @livewire('configuracion.financiero.sub-generica-nivel-1.table')
@endsection
@section('script')
@endsection
