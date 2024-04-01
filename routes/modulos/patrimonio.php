<?php
//Dashboard Principal

Route::prefix('/patrimonio')->group(function () {
        Route::get('/index', function () { return view('livewire.rrhh.index'); })->name('patrimonio');
        Route::get('/inventariado', function () { return view('livewire.rrhh.index'); })->name('patrimonio/inventariado');
        Route::get('/por-persona', function () { return view('livewire.rrhh.index'); })->name('patrimonio/inventariado/por-persona');
        Route::get('/por-equipo', function () { return view('livewire.rrhh.index'); })->name('patrimonio/inventariado/por-equipo');
});