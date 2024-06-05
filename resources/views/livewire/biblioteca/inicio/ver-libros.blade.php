@extends('layouts.libreria.ver-libros')

@section('xcontent')
<div class="container">
    @livewire('biblioteca.inicio.filtro')    
    @livewire('biblioteca.inicio.listar-libros')
</div>
    
    
@endsection