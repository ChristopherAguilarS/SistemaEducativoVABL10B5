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

        Route::get('/año-academico', function () { return view('livewire.academico.año-academico.index'); })->name('academico/año-academico');
        Route::get('/tipo-ciclo', function () { return view('livewire.academico.tipo-ciclo.index'); })->name('academico/tipo-ciclo');
        Route::get('/ciclo', function () { return view('livewire.academico.ciclo.index'); })->name('academico/ciclo');
        Route::get('/persona', function () { return view('livewire.academico.persona.index'); })->name('academico/persona');
        Route::get('/estudiante', function () { return view('livewire.academico.estudiante.index'); })->name('academico/estudiante');
        Route::get('/tipo-ingreso', function () { return view('livewire.academico.tipo-ingreso.index'); })->name('academico/tipo-ingreso');
        Route::get('/concepto-ingreso', function () { return view('livewire.academico.concepto-ingreso.index'); })->name('academico/concepto-ingreso');
});