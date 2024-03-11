<?php
//Dashboard Principal

Route::prefix('/rrhh')->group(function () {
        Route::get('/index', function () { return view('livewire.rrhh.index'); })->name('rrhh');
        Route::get('/personal/personal', function () { return view('livewire.rrhh.personal.index'); })->name('rrhh/personal/personal');
        Route::get('/personal/escalafon', function () { return view('livewire.rrhh.index'); })->name('rrhh/personal/escalafon');
        Route::get('/trabajadores', function () { return view('livewire.rrhh.trabajadores.index'); })->name('rrhh/trabajadores');
        Route::get('/horarios', function () { return view('livewire.rrhh.index'); })->name('rrhh/horarios');
        Route::get('/horarios/programacion-mensual', function () { return view('livewire.rrhh.index'); })->name('rrhh/horarios/programacion-mensual');
        Route::get('/horarios/turnos', function () { return view('livewire.rrhh.index'); })->name('rrhh/horarios/turnos');
        Route::get('/asistencias', function () { return view('livewire.rrhh.index'); })->name('rrhh/asistencias');
        Route::get('/asistencias/asistencia', function () { return view('livewire.rrhh.index'); })->name('rrhh/asistencias/asistencia');
        Route::get('/asistencias/permisos-licencias', function () { return view('livewire.rrhh.index'); })->name('rrhh/asistencias/permisos-licencias');
        Route::get('/reportes', function () { return view('livewire.rrhh.index'); })->name('rrhh/reportes');
});