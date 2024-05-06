<?php
//Dashboard Principal

Route::prefix('/mesa-partes')->group(function () {
        Route::get('/index', function () { return view('livewire.mesa-partes.index'); })->name('mesa-partes/index');
        Route::get('/registro-documento', function () { return view('livewire.mesa-partes.registro-documento.index'); })->name('mesa-partes/registro-documento');
        Route::get('/busqueda-documento', function () { return view('livewire.mesa-partes.busqueda-documento.index'); })->name('mesa-partes/busqueda-documento');
        Route::get('/configuracion/catalog-tipo-documento', function () { return view('livewire.mesa-partes.configuracion.catalogo-tipo-documento.index'); })->name('mesa-partes/configuracion/catalog-tipo-documento');
});