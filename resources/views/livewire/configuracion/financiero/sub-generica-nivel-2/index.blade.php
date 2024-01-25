@extends('layouts.master')
@section('title')
    Sub Genericas Nivel 2
@endsection
@section('css')
   
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Finaciero
        @endslot
        @slot('title')
        Sub Genericas Nivel 2
        @endslot
    @endcomponent
    @livewire('configuracion.financiero.sub-generica-nivel-2.filtro')
    @livewire('configuracion.financiero.sub-generica-nivel-2.table')
@endsection
@section('script')
@endsection
