<?php
//Dashboard Principal
Route::prefix('/academico')->group(function () {
        Route::get('/index', function () { return view('livewire.rrhh.index'); })->name('academico/index');
        Route::get('/no-autorizado', function () { return view('livewire.rrhh.index'); })->name('academico/academico');
        Route::get('/academico/inicio', function () { return view('livewire.rrhh.index'); })->name('academico/academico/inicio');
        Route::get('/academico/matriculas', function () { return view('livewire.academico.academico.matriculas.index'); })->name('academico/academico/matriculas');
        Route::get('/academico/tesoreria', function () { return view('livewire.academico.caja.index'); })->name('academico/tesoreria');
        Route::get('/ventas/otros-conceptos', function () { return view('livewire.academico.ventas.otros-conceptos.index'); })->name('academico/ventas/otros-conceptos');
        Route::get('/ventas/matriculas', function () { return view('livewire.academico.ventas.matriculas.index'); })->name('academico/ventas/matriculas');
        Route::get('/ventas/mensualidades', function () { return view('livewire.academico.ventas.mensualidades.index'); })->name('academico/ventas/mensualidades');
        Route::get('/academico/reportes/ventas', function () { return view('livewire.rrhh.index'); })->name('academico/reportes/ventas');

        Route::get('/administracion/plan-academico', function () { return view('livewire.academico.administracion.plan-academico.index'); })->name('academico/administracion/plan-academico');
        Route::get('/administracion/carreras', function () { return view('livewire.academico.administracion.carreras.index'); })->name('academico/administracion/carreras');
        Route::get('/administracion/cursos', function () { return view('livewire.academico.administracion.cursos.index'); })->name('academico/administracion/cursos');
        Route::get('/administracion/secciones', function () { return view('livewire.rrhh.index'); })->name('academico/administracion/secciones');
});