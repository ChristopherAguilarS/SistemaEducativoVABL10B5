<?php
//Dashboard Principal

Route::prefix('/patrimonio')->group(function () {
        Route::get('/index', function () { return view('livewire.patrimonio.index'); })->name('patrimonio/index');
        Route::get('/inventariado', function () { return view('livewire.rrhh.index'); })->name('patrimonio/inventariado');
        Route::get('/inventariado/por-ambiente', function () { return view('livewire.patrimonio.por-ambiente.index'); })->name('patrimonio/inventariado/por-ambiente');
        Route::get('/inventariado/por-persona', function () { return view('livewire.patrimonio.por-persona.index'); })->name('patrimonio/inventariado/por-persona');
        Route::get('/inventariado/por-equipo', function () { return view('livewire.patrimonio.por-equipo.index'); })->name('patrimonio/inventariado/por-equipo');
        Route::get('/reportes/equipos-situacion', function () { return view('livewire.patrimonio.reportes.equipos-situacion.index'); })->name('patrimonio/reportes/equipos-situacion');
        Route::get('/reportes/equipos-prestados', function () { return view('livewire.patrimonio.reportes.equipos-prestados.index'); })->name('patrimonio/reportes/equipos-prestados');
        Route::get('/patrimonio/impresion', function () { return view('livewire.rrhh.index'); })->name('patrimonio/impresion');
        Route::get('/patrimonio/prestamos', function () { return view('livewire.patrimonio.prestamos.index'); })->name('patrimonio/prestamos');
        Route::get('/patrimonio/ambientes', function () { return view('livewire.patrimonio.ambientes.index'); })->name('patrimonio/ambientes');
        Route::get('/configuracion/familias', function () { return view('livewire.patrimonio.configuracion.familias.index'); })->name('patrimonio/configuracion/familias');
        Route::get('/configuracion/inventariado-anios', function () { return view('livewire.patrimonio.configuracion.inventariado-anios.index'); })->name('patrimonio/configuracion/inventariado-anios');

        Route::get('/configuracion/tipos-ambientes', function () { return view('livewire.patrimonio.configuracion.catalogo-tipos-ambientes.index'); })->name('patrimonio/configuracion/tipos-ambientes');
        Route::get('/configuracion/ubicaciones', function () { return view('livewire.patrimonio.configuracion.catalogo-ubicaciones.index'); })->name('patrimonio/configuracion/ubicaciones');
        Route::get('/configuracion/usos-ambientes', function () { return view('livewire.patrimonio.configuracion.catalogo-uso-ambientes.index'); })->name('patrimonio/configuracion/usos-ambientes');
        Route::get('/configuracion/catalogo-tipo-techo', function () { return view('livewire.patrimonio.configuracion.catalogo-tipo-techo.index'); })->name('patrimonio/configuracion/catalogo-tipo-techo');
        Route::get('/configuracion/catalogo-tipo-piso', function () { return view('livewire.patrimonio.configuracion.catalogo-tipo-piso.index'); })->name('patrimonio/configuracion/catalogo-tipo-piso');
        Route::get('/configuracion/pisos', function () { return view('livewire.patrimonio.configuracion.catalogo-pisos.index'); })->name('patrimonio/configuracion/pisos');
        Route::get('/configuracion/catalogo-pabellones', function () { return view('livewire.patrimonio.configuracion.catalogo-pabellones.index'); })->name('patrimonio/configuracion/catalogo-pabellones');
});
Route::get('/inventariado/{anio}/{persona}', [App\Livewire\Patrimonio\PorPersona\Filtro::class, 'verInventariado'])->name('ver-inventariado');
Route::get('/qr/equipo/{id}', function () { return view('livewire.patrimonio.qr.index'); })->name('qr/equipo');