<?php
//Dashboard Principal

Route::prefix('/financiero-contable')->group(function () {
        Route::get('/index', function () { return view('livewire.financiero-contable.index'); })->name('financiero-contable');
        Route::prefix('/contabilidad')->group(function () {
                Route::get('/', function () { return view('livewire.financiero-contable.contabilidad.index'); })->name('financiero-contable/contabilidad');
                Route::get('/caja-bancos', function () {
                        return view('livewire.financiero-contable.contabilidad.caja-bancos.index');
                })->name('financiero-contable/contabilidad/caja-bancos');
                Route::get('/asientos-contables', function () {
                        return view('livewire.financiero-contable.contabilidad.asientos-contables.index');
                })->name('financiero-contable/contabilidad/asientos-contables');
                Route::get('/caja-chica', function () {
                        return view('livewire.financiero-contable.contabilidad.caja-chica.index');
                })->name('financiero-contable/contabilidad/caja-chica');
        });
        Route::prefix('/presupuestal')->group(function () {
                Route::get('/', function () { return view('livewire.financiero-contable.contabilidad.index'); })->name('financiero-contable/contabilidad');
                Route::get('/objetivos-estrategicos', function () {
                        return view('livewire.financiero-contable.presupuestal.objetivos-estrategicos.index');
                })->name('financiero-contable/presupuestal/objetivos-estrategicos');
                Route::get('/actvidades-operativas', function () {
                        return view('livewire.financiero-contable.presupuestal.actividades-operativas.index');
                })->name('financiero-contable/presupuestal/actividades-operativas');
                Route::get('/plan-anual-trabajo', function () {
                        return view('livewire.financiero-contable.presupuestal.plan-anual-trabajo.index');
                })->name('financiero-contable/presupuestal/plan-anual-trabajo');
        });
        Route::prefix('/compras')->group(function () {
                Route::get('/', function () { return view('livewire.financiero-contable.contabilidad.index'); })->name('financiero-contable/compras');
                Route::get('/pedidos', function () {
                        return view('livewire.financiero-contable.presupuestal.objetivos-estrategicos.index');
                })->name('financiero-contable/compras/pedidos');
                Route::get('/ordenes', function () {
                        return view('livewire.financiero-contable.presupuestal.objetivos-estrategicos.index');
                })->name('financiero-contable/compras/ordenes');
                Route::get('/ingresos', function () {
                        return view('livewire.financiero-contable.presupuestal.objetivos-estrategicos.index');
                })->name('financiero-contable/compras/ingresos');
        });
        Route::get('/', function () { return view('livewire.financiero-contable.contabilidad.index'); })->name('financiero-contable/caja');
});