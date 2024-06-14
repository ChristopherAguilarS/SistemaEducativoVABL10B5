<?php
//Dashboard Principal

Route::prefix('/financiero-contable')->group(function () {
        Route::get('/index', function () { return view('livewire.financiero-contable.index'); })->name('financiero-contable/index');
        Route::prefix('/contabilidad')->group(function () {
                Route::get('/', function () { return view('livewire.financiero-contable.contabilidad.index'); })->name('financiero-contable/contabilidad');
                Route::get('/caja-bancos', function () {
                        return view('livewire.financiero-contable.contabilidad.caja-bancos.index');
                })->name('financiero-contable/contabilidad/caja-bancos');
                Route::get('/notas-contables', function () {
                        return view('livewire.financiero-contable.contabilidad.notas-contables.index');
                })->name('financiero-contable/contabilidad/notas-contables');
                Route::get('/asientos-contables', function () {
                        return view('livewire.financiero-contable.contabilidad.asientos-contables.index');
                })->name('financiero-contable/contabilidad/asientos-contables');
                Route::get('/caja-chica', function () {
                        return view('livewire.financiero-contable.contabilidad.caja-chica.index');
                })->name('financiero-contable/contabilidad/caja-chica');
                Route::get('/movimiento-caja-chica', function () {
                        return view('livewire.financiero-contable.contabilidad.movimiento-caja-chica.index');
                })->name('financiero-contable/contabilidad/movimiento-caja-chica');
        });
        Route::prefix('/presupuestal')->group(function () {
                Route::get('/', function () { return view('livewire.financiero-contable.contabilidad.index'); })->name('financiero-contable/contabilidad');
                Route::get('/tipo-procesos', function () {
                        return view('livewire.financiero-contable.presupuestal.tipo-procesos.index');
                })->name('financiero-contable/presupuestal/tipo-procesos');
                Route::get('/macro-procesos', function () {
                        return view('livewire.financiero-contable.presupuestal.macro-procesos.index');
                })->name('financiero-contable/presupuestal/macro-procesos');
                Route::get('/procesos', function () {
                        return view('livewire.financiero-contable.presupuestal.procesos.index');
                })->name('financiero-contable/presupuestal/procesos');
                Route::get('/objetivos-estrategicos', function () {
                        return view('livewire.financiero-contable.presupuestal.objetivos-estrategicos.index');
                })->name('financiero-contable/presupuestal/objetivos-estrategicos');
                Route::get('/acciones-estrategicas-priorizadas', function () {
                        return view('livewire.financiero-contable.presupuestal.acciones-estrategicas-priorizadas.index');
                })->name('financiero-contable/presupuestal/acciones-estrategicas-priorizadas');
                Route::get('/actvidades-operativas', function () {
                        return view('livewire.financiero-contable.presupuestal.actividades-operativas.index');
                })->name('financiero-contable/presupuestal/actividades-operativas');
                Route::get('/plan-anual-trabajo', function () {
                        return view('livewire.financiero-contable.presupuestal.plan-anual-trabajo.index');
                })->name('financiero-contable/presupuestal/plan-anual-trabajo');
                Route::get('/indicadores', function () {
                        return view('livewire.financiero-contable.presupuestal.indicadores.index');
                })->name('financiero-contable/presupuestal/indicador');
                Route::get('/tareas', function () {
                        return view('livewire.financiero-contable.presupuestal.tareas.index');
                })->name('financiero-contable/presupuestal/tarea');
                Route::get('/resumen-ejecucion', function () {
                        return view('livewire.financiero-contable.presupuestal.resumen-ejecucion.index');
                })->name('financiero-contable/presupuestal/resumen-ejecucion');
                Route::get('/responsables', function () {
                        return view('livewire.financiero-contable.presupuestal.responsables.index');
                })->name('financiero-contable/presupuestal/responsables');
        });
        Route::prefix('/compras')->group(function () {
                Route::get('/', function () { return view('livewire.financiero-contable.contabilidad.index'); })->name('financiero-contable/compras');
                Route::get('/pedidos', function () { return view('livewire.financiero-contable.compras.pedidos.index'); })->name('financiero-contable/compras/pedidos');
                Route::get('/ordenes', function () { return view('livewire.financiero-contable.compras.compras.index'); })->name('financiero-contable/compras/ordenes');
                Route::get('/ingresos', function () { return view('livewire.financiero-contable.compras.ingresos.index'); })->name('financiero-contable/compras/ingresos');
        });

        Route::prefix('/pedidos')->group(function () {
                Route::get('/', function () { return view('livewire.financiero-contable.contabilidad.index'); })->name('financiero-contable/compras');
                Route::get('/crear_requerimientos', function () { return view('livewire.financiero-contable.pedidos.crear-requerimientos.index'); })->name('financiero-contable/pedidos/crear-requerimientos');
                Route::get('/orden_servicio', function () { return view('livewire.financiero-contable.pedidos.orden-servicio.index'); })->name('financiero-contable/pedidos/orden-servicio');
                Route::get('/orden_compra', function () { return view('livewire.financiero-contable.pedidos.orden-compra.index'); })->name('financiero-contable/pedidos/orden-compra');
                Route::get('/crear_pedidos', function () { return view('livewire.financiero-contable.pedidos.crear-pedidos.index'); })->name('financiero-contable/pedidos/crear-pedidos');
                Route::get('/aprobar_requerimientos', function () { return view('livewire.financiero-contable.pedidos.aprobar-requerimientos.index'); })->name('financiero-contable/pedidos/aprobar-requerimientos');
                Route::get('/ordenes', function () { return view('livewire.financiero-contable.compras.ingresos.index'); })->name('financiero-contable/compras/ingresos');
        });
        Route::prefix('/configuracion')->group(function () {
                Route::get('/', function () { return view('livewire.financiero-contable.configuracion.catalogo-insumos.index'); })->name('financiero-contable/configuracion');
                Route::get('/catalogo-insumos', function () {
                        return view('livewire.financiero-contable.configuracion.catalogo-insumos.index');
                })->name('financiero-contable/configuracion/catalogo-insumos');
        });
        Route::get('/', function () { return view('livewire.financiero-contable.contabilidad.index'); })->name('financiero-contable/caja');
});