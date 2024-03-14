@extends('layouts.master')
@section('title')
    Compras
@endsection
@section('css')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Compras
        @endslot
        @slot('title')
            Pedidos
        @endslot
    @endcomponent
    @livewire('financiero-contable.compras.pedidos.filtro')
    @livewire('financiero-contable.compras.pedidos.table')
    @livewire('financiero-contable.compras.pedidos.ver-detalles')
    @livewire('financiero-contable.compras.pedidos.components.listar-items')
    <script>
    $('#form1').on('show.bs.modal', function (e) {
        $(this).css('z-index', 1050); // Ajusta el z-index de la primera modal al mostrarse
    });

    $('#form2').on('show.bs.modal', function (e) {
        $(this).css('z-index', 1060); // Ajusta el z-index de la segunda modal al mostrarse
    });
</script>
@endsection
