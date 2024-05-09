<?php
//Dashboard Principal
Route::prefix('/configuracion')->group(function () {
        Route::get('/index', function () { return view('livewire.rrhh.index'); })->name('configuracion/index');
        Route::get('/inicio', function () { return view('livewire.rrhh.index'); })->name('configuracion/inicio');
        Route::get('/roles-usuarios/roles', function () { return view('livewire.configuracion.roles.index'); })->name('configuracion/roles-usuarios/roles');
        Route::get('/roles-usuarios/usuarios', function () { return view('livewire.configuracion.usuarios.index'); })->name('configuracion/roles-usuarios/usuarios');
});