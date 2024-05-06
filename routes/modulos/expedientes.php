<?php
//Dashboard Principal

Route::prefix('/expedientes')->group(function () {
        Route::get('/index', function () { return view('livewire.expedientes.index'); })->name('expedientes/index');
        Route::get('/expedientes', function () { return view('livewire.expedientes.expedientes.index'); })->name('expedientes/expedientes');
        Route::get('/busqueda-documento', function () { return view('livewire.expedientes.index'); })->name('expedientes/busqueda-documento');
});