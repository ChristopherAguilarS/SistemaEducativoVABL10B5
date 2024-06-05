<?php
//Dashboard Principal

Route::prefix('/biblioteca')->group(function () {
        
        Route::get('/index', function () { return view('livewire.biblioteca.index'); })->name('biblioteca/index');
        Route::get('/configuracion/catalogo-editoriales', function () { return view('livewire.biblioteca.configuracion.catalogo-editoriales.index'); })->name('biblioteca/configuracion/catalogo-editoriales');
        Route::get('/configuracion/catalogo-autores', function () { return view('livewire.biblioteca.configuracion.catalogo-autores.index'); })->name('biblioteca/configuracion/catalogo-autores');
        Route::get('/configuracion/catalogo-materias', function () { return view('livewire.biblioteca.configuracion.catalogo-materias.index'); })->name('biblioteca/configuracion/catalogo-materias');
        Route::get('/configuracion/catalogo-categorias', function () { return view('livewire.biblioteca.configuracion.catalogo-categorias.index'); })->name('biblioteca/configuracion/catalogo-categorias');
        Route::get('/configuracion/catalogo-idiomas', function () { return view('livewire.biblioteca.configuracion.catalogo-idiomas.index'); })->name('biblioteca/configuracion/catalogo-idiomas');
        Route::get('/configuracion/catalogo-tipo-ingreso', function () { return view('livewire.biblioteca.configuracion.catalogo-tipo-ingreso.index'); })->name('biblioteca/configuracion/catalogo-tipo-ingreso');
        Route::get('/adquisiciones', function () { return view('livewire.biblioteca.adquisiciones.index'); })->name('biblioteca/adquisiciones');
        Route::get('/libros', function () { return view('livewire.biblioteca.libros.index'); })->name('biblioteca/libros');
        Route::get('/reservas-entregas', function () { return view('livewire.biblioteca.reservas-entregas.index'); })->name('biblioteca/reservas-entregas');
        Route::get('/entrega-libros', function () { return view('livewire.biblioteca.entrega-libros.index'); })->name('biblioteca/entrega-libros');
        Route::get('/fotochecks', function () { return view('livewire.biblioteca.fotochecks.index'); })->name('biblioteca/fotochecks');
});
Route::get('/biblioteca/carnet/{id}', [App\Livewire\Biblioteca\Fotochecks\Filtro::class, 'verFotocheck'])->name('ver-fotocheck');