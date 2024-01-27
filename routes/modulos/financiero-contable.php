<?php
//Dashboard Principal

Route::prefix('/financiero-contable')->group(function () {
        Route::get('/', function () { return view('livewire.rrhh.inicio.index'); })->name('financiero-contable')->middleware('menu');
});