<?php
//Dashboard Principal

Route::prefix('/academico')->group(function () {
        Route::get('/index', function () { return view('livewire.academico.index'); })->name('academico');
        Route::get('/año-academico', function () { return view('livewire.academico.año-academico.index'); })->name('academico/año-academico');
        Route::get('/tipo-ciclo', function () { return view('livewire.academico.tipo-ciclo.index'); })->name('academico/tipo-ciclo');
        Route::get('/ciclo', function () { return view('livewire.academico.ciclo.index'); })->name('academico/ciclo');
        Route::get('/persona', function () { return view('livewire.academico.persona.index'); })->name('academico/persona');
        Route::get('/estudiante', function () { return view('livewire.academico.estudiante.index'); })->name('academico/estudiante');
        Route::get('/tipo-ingreso', function () { return view('livewire.academico.tipo-ingreso.index'); })->name('academico/tipo-ingreso');
        Route::get('/concepto-ingreso', function () { return view('livewire.academico.concepto-ingreso.index'); })->name('academico/concepto-ingreso');
});