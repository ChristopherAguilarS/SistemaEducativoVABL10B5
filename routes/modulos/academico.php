<?php
//Dashboard Principal
Route::prefix('/academico')->group(function () {
        Route::get('/index', function () { return view('livewire.rrhh.index'); })->name('academico');
        Route::get('/academico/inicio', function () { return view('livewire.rrhh.index'); })->name('academico/academico/inicio');
        Route::get('/academico/matriculas', function () { return view('livewire.academico.academico.matriculas.index'); })->name('academico/academico/matriculas');
        Route::get('/academico/tesoreria', function () { return view('livewire.rrhh.index'); })->name('academico/tesoreria');
        Route::get('/academico/ventas/otros-conceptos', function () { return view('livewire.rrhh.index'); })->name('academico/ventas/otros-conceptos');
        Route::get('/academico/ventas/matriculas', function () { return view('livewire.rrhh.index'); })->name('academico/ventas/matriculas');
        Route::get('/academico/ventas/mensualidades', function () { return view('livewire.rrhh.index'); })->name('academico/ventas/mensualidades');
        Route::get('/academico/reportes/ventas', function () { return view('livewire.rrhh.index'); })->name('academico/reportes/ventas');

        Route::get('/administracion/plan-academico', function () { return view('livewire.academico.administracion.plan-academico.index'); })->name('academico/administracion/plan-academico');
        Route::get('/administracion/carreras', function () { return view('livewire.academico.administracion.carreras.index'); })->name('academico/administracion/carreras');
        Route::get('/administracion/semestres', function () { return view('livewire.academico.administracion.semestres.index'); })->name('academico/administracion/semestres');
        Route::get('/administracion/secciones', function () { return view('livewire.rrhh.index'); })->name('academico/administracion/secciones');
});