<?php
//Dashboard Principal

Route::prefix('/patrimonio')->group(function () {
        Route::get('/', function () { return view('livewire.rrhh.inicio.index'); })->name('patrimonio')->middleware('menu');
});