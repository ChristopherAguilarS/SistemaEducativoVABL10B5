<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
Route::middleware('auth')->group(function () {
    Route::get('/', function () {return view('inicio');})->name('inicio');
        
});
Route::get('/clear', function() {
    // Artisan::call('vendor:publish');
     Artisan::call('cache:clear');
     Artisan::call('config:clear');
     Artisan::call('view:clear');
     Artisan::call('config:cache');
     Artisan::call('key:generate');
 });


//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
//Route::get('/rrhh/index', function () { return view('livewire.configuracion.financiero.tipo-transaccion.index'); })->name('rrhh');
Route::prefix('/configuracion')->group(function () {
    Route::get('/index', function () { return view('livewire.configuracion.index'); })->name('configuracion/index');
    Route::prefix('/financiero')->group(function () {
        Route::get('/', function () { return view('livewire.configuracion.financiero.index'); })->name('configuracion/financiero');
        Route::get('/tipo-transaccion', function () {
            return view('livewire.configuracion.financiero.tipo-transaccion.index');
        })->name('configuracion/financiero/tipo-transaccion');
        Route::get('/generica', function () {
            return view('livewire.configuracion.financiero.generica.index');
        })->name('configuracion/financiero/generica');
        Route::get('/sub-generica-nivel-1', function () {
            return view('livewire.configuracion.financiero.sub-generica-nivel-1.index');
        })->name('configuracion/financiero/sub-generica-nivel-1');
        Route::get('/sub-generica-nivel-2', function () {
            return view('livewire.configuracion.financiero.sub-generica-nivel-2.index');
        })->name('configuracion/financiero/sub-generica-nivel-2');
        Route::get('/especifica-nivel-1', function () {
            return view('livewire.configuracion.financiero.especifica-nivel-1.index');
        })->name('configuracion/financiero/especifica-nivel-1');
        Route::get('/especifica-nivel-2', function () {
            return view('livewire.configuracion.financiero.especifica-nivel-2.index');
        })->name('configuracion/financiero/especifica-nivel-2');
    });
    Route::prefix('/contabilidad')->group(function () {
        Route::get('/', function () { return view('livewire.configuracion.contabilidad.index'); })->name('configuracion/contabilidad');
        Route::get('/cuentas', function () {
            return view('livewire.configuracion.contable.cuentas.index');
        })->name('configuracion/contabilidad/cuentas');
    });
});
Route::prefix('/contable')->group(function () {
    Route::get('/caja-bancos', function () {
        return view('livewire.contable.caja-bancos.index');
    })->name('caja-bancos');
});

Route::middleware('auth')->group(__DIR__ . '/modulos/rrhh.php');
Route::middleware('auth')->group(__DIR__ . '/modulos/academico.php');
Route::middleware('auth')->group(__DIR__ . '/modulos/biblioteca.php');
Route::middleware('auth')->group(__DIR__ . '/modulos/mesa-partes.php');
Route::middleware('auth')->group(__DIR__ . '/modulos/expedientes.php');
Route::middleware('auth')->group(__DIR__ . '/modulos/patrimonio.php');
Route::middleware('auth')->group(__DIR__ . '/modulos/financiero-contable.php');
Route::middleware('auth')->group(__DIR__ . '/modulos/administracion.php');
Route::middleware('auth')->group(__DIR__ . '/modulos/configuracion.php');
