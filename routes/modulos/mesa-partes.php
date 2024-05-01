<?php
//Dashboard Principal

Route::prefix('/mesa-partes')->group(function () {
        Route::get('/', function () { return view('livewire.rrhh.inicio.index'); })->name('mesa-partes/index')->middleware('menu');
});