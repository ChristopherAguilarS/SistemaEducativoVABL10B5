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
    <div class="col-xl-3 col-md-6">
        <a href="/qr/equipo/0" class="card card-animate" style="background-color:#f95900">
            <div class="card-body text-center">
                <i class="mdi mdi-qrcode-scan" style="font-size:60px; color:white"></i>
                <br>
                <b style="font-size:20px; color:white" class="top:4px">Aplicativo QR</b>
            </div><!-- end card body -->
        </a><!-- end card -->
    </div>
@endsection
@section('script')
@endsection
