<?php
//Dashboard Principal

Route::prefix('/academico')->group(function () {
        Route::get('/', function () { return view('livewire.rrhh.inicio.index'); })->name('academico')->middleware('menu');
});