<?php
//Dashboard Principal
Route::prefix('/academico')->group(function () {
        Route::get('/index', function () { return view('livewire.rrhh.index'); })->name('academico');
        Route::get('/academico/inicio', function () { return view('livewire.rrhh.index'); })->name('academico/academico/inicio');
        Route::get('/academico/matriculas', function () { return view('livewire.rrhh.index'); })->name('academico/academico/matriculas');
        Route::get('/academico/tesoreria', function () { return view('livewire.rrhh.index'); })->name('academico/tesoreria');
        Route::get('/academico/ventas/otros-conceptos', function () { return view('livewire.rrhh.index'); })->name('academico/ventas/otros-conceptos');
        Route::get('/academico/ventas/matriculas', function () { return view('livewire.rrhh.index'); })->name('academico/ventas/matriculas');
        Route::get('/academico/ventas/mensualidades', function () { return view('livewire.rrhh.index'); })->name('academico/ventas/mensualidades');
        Route::get('/academico/reportes/ventas', function () { return view('livewire.rrhh.index'); })->name('academico/reportes/ventas');

        Route::get('/academico/administracion/plan-academico', function () { return view('livewire.rrhh.index'); })->name('academico/administracion/plan-academico');
        Route::get('/academico/administracion/niveles', function () { return view('livewire.rrhh.index'); })->name('academico/administracion/niveles');
        Route::get('/academico/administracion/grados', function () { return view('livewire.rrhh.index'); })->name('academico/administracion/grados');
        Route::get('/academico/administracion/secciones', function () { return view('livewire.rrhh.index'); })->name('academico/administracion/secciones');
});