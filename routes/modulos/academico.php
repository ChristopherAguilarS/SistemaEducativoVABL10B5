<?php
//Dashboard Principal
Route::prefix('/academico')->group(function () {
        Route::get('/index', function () { return view('livewire.rrhh.index'); })->name('academico/index');
        Route::get('/no-autorizado', function () { return view('livewire.rrhh.index'); })->name('academico/academico');
        Route::get('/academico/inicio', function () { return view('livewire.rrhh.index'); })->name('academico/academico/inicio');
        Route::get('/academico/matriculas', function () { return view('livewire.academico.academico.matriculas.index'); })->name('academico/academico/matriculas');
        Route::get('/academico/tesoreria', function () { return view('livewire.academico.caja.index'); })->name('academico/tesoreria');
        Route::get('/academico/aprobacion-postulantes', function () { return view('livewire.academico.aprobacion-postulante.index'); })->name('academico/aprobacion-postulantes');
        Route::get('/ventas/otros-conceptos', function () { return view('livewire.academico.ventas.otros-conceptos.index'); })->name('academico/ventas/otros-conceptos');
        Route::get('/ventas/matriculas', function () { return view('livewire.academico.ventas.matriculas.index'); })->name('academico/ventas/matriculas');
        Route::get('/ventas/mensualidades', function () { return view('livewire.academico.ventas.mensualidades.index'); })->name('academico/ventas/mensualidades');
        Route::get('/academico/reportes/ventas', function () { return view('livewire.rrhh.index'); })->name('academico/reportes/ventas');
        Route::get('/administracion/plan-academico', function () { return view('livewire.academico.administracion.plan-academico.index'); })->name('academico/administracion/plan-academico');
        Route::get('/academico/malla-curricular', function () { return view('livewire.academico.malla-curricular.index'); })->name('academico/malla-curricular');
        Route::get('/academico/matriculas', function () { return view('livewire.academico.matricula.index'); })->name('academico/matriculas');
        Route::get('/academico/cursos', function () { return view('livewire.academico.curso.index'); })->name('academico/cursos');
        Route::get('/academico/cursos-ciclos', function () { return view('livewire.academico.curso-ciclo.index'); })->name('academico/curso-ciclos');
        Route::get('/academico/ingresos', function () { return view('livewire.academico.ingreso.index'); })->name('academico/ingresos');
        

        Route::get('/administracion/plan-academico', function () { return view('livewire.academico.administracion.plan-academico.index'); })->name('academico/administracion/plan-academico');
        Route::get('/administracion/carreras', function () { return view('livewire.academico.administracion.carreras.index'); })->name('academico/administracion/carreras');
        Route::get('/administracion/cursos', function () { return view('livewire.academico.administracion.cursos.index'); })->name('academico/administracion/cursos');
        Route::get('/administracion/secciones', function () { return view('livewire.rrhh.index'); })->name('academico/administracion/secciones');
        Route::get('/academico/año-academico', function () { return view('livewire.academico.año-academico.index'); })->name('academico/año-academico');
        Route::get('/academico/tipo-ciclo', function () { return view('livewire.academico.tipo-ciclo.index'); })->name('academico/tipo-ciclo');
        Route::get('/academico/ciclo', function () { return view('livewire.academico.ciclo.index'); })->name('academico/ciclo');
        Route::get('/academico/persona', function () { return view('livewire.academico.persona.index'); })->name('academico/persona');
        Route::prefix('/postulante')->group(function () {
                Route::get('/', function () { return view('livewire.financiero-contable.contabilidad.index'); })->name('financiero-contable/contabilidad');
                Route::get('/academico/postulante-fc', function () { return view('livewire.academico.postulante-fc.index'); })->name('academico/postulante/postulante-fc');
                Route::get('/academico/postulante-fid', function () { return view('livewire.academico.postulante-fid.index'); })->name('academico/postulante/postulante-fid');
        });
        Route::get('/academico/estudiante', function () { return view('livewire.academico.estudiante.index'); })->name('academico/estudiante');
        Route::get('/academico/tipo-ingreso', function () { return view('livewire.academico.tipo-ingreso.index'); })->name('academico/tipo-ingreso');
        Route::get('/academico/concepto-ingreso', function () { return view('livewire.academico.concepto-ingreso.index'); })->name('academico/concepto-ingreso');
        Route::get('/academico/programa-estudios', function () { return view('livewire.academico.programa-estudios.index'); })->name('academico/programa-estudios');
});