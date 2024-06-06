@extends('layouts.master')
@section('title')
    Cuentas
@endsection
@section('css')
   
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Contable
        @endslot
        @slot('title')
            Cuentas
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <a href="/mesa-partes/registro-documento" class="card card-animate" style="background-color:#f95900">
                <div class="card-body text-center">
                    <i class="mdi mdi-bookmark-box-multiple" style="font-size:60px; color:white"></i>
                    <br>
                    <b style="font-size:20px; color:white" class="top:4px">Registro de Documentos</b>
                </div><!-- end card body -->
            </a><!-- end card -->
        </div>
        <div class="col-xl-3 col-md-6">
            <a href="/mesa-partes/busqueda-documento" class="card card-animate" style="background-color:#f95900">
                <div class="card-body text-center">
                    <i class="mdi mdi-archive-search-outline" style="font-size:60px; color:white"></i>
                    <br>
                    <b style="font-size:20px; color:white" class="top:4px">Busqueda de Documentos</b>
                </div><!-- end card body -->
            </a><!-- end card -->
        </div>
    </div>
    
@endsection
@section('script')
@endsection
