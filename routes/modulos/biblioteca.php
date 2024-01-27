<?php
//Dashboard Principal

Route::prefix('/biblioteca')->group(function () {
        Route::get('/', function () { return view('livewire.rrhh.inicio.index'); })->name('biblioteca')->middleware('menu');
});