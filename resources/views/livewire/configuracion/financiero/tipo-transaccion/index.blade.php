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
            Tipos de Transacciones
        @endslot
    @endcomponent
    @livewire('configuracion.financiero.tipo-transaccion.filtro')
    @livewire('configuracion.financiero.tipo-transaccion.table')
@endsection
@section('script')
@endsection
