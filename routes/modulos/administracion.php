<?php
//Dashboard Principal

Route::prefix('/administracion')->group(function () {
        Route::get('/', function () { return view('livewire.rrhh.inicio.index'); })->name('administracion/index')->middleware('menu');
});