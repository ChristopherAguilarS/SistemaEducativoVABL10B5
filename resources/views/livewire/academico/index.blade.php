@extends('layouts.master')
@section('title')
    Año Academico
@endsection
@section('css')
   
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Academico
        @endslot
        @slot('title')
            Año Academico
        @endslot
    @endcomponent
    @livewire('academico.año-academico.filtro')
    @livewire('academico.año-academico.table')
@endsection
@section('script')
@endsection