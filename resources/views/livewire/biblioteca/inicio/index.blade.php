@extends('layouts.libreria.inicio')

@section('xcontent')
<div class="container">
    @livewire('biblioteca.inicio.filtro')    
    @livewire('biblioteca.inicio.listar-libros')
</div>
    
    
@endsection