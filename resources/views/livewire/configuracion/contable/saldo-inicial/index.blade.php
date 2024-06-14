@extends('layouts.master')
@section('title')
    Saldo Inicial
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Contable
        @endslot
        @slot('title')
            Saldo Inicial
        @endslot
    @endcomponent
    @livewire('configuracion.contable.saldo-inicial.filtro')
    @livewire('configuracion.contable.saldo-inicial.table')
@endsection
@section('script')
@endsection
