<?php
//Dashboard Principal

Route::prefix('/patrimonio')->group(function () {
        Route::get('/index', function () { return view('livewire.patrimonio.index'); })->name('patrimonio/index');
        Route::get('/inventariado', function () { return view('livewire.rrhh.index'); })->name('patrimonio/inventariado');
        Route::get('/inventariado/por-persona', function () { return view('livewire.patrimonio.por-persona.index'); })->name('patrimonio/inventariado/por-persona');
        Route::get('/por-equipo', function () { return view('livewire.rrhh.index'); })->name('patrimonio/inventariado/por-equipo');
        Route::get('/reportes/equipos-situacion', function () { return view('livewire.rrhh.index'); })->name('patrimonio/reportes/equipos-situacion');
        Route::get('/patrimonio/impresion', function () { return view('livewire.rrhh.index'); })->name('patrimonio/impresion');
        Route::get('/patrimonio/configuracion/familias', function () { return view('livewire.rrhh.index'); })->name('patrimonio/configuracion/familias');
       
});
Route::get('/inventariado/{anio}/{persona}', [App\Livewire\Patrimonio\PorPersona\Filtro::class, 'verInventariado'])->name('ver-inventariado');
Route::get('/qr/equipo/{id}', function () { return view('livewire.patrimonio.qr.index'); })->name('qr/equipo');