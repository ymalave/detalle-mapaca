<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Configuracion\ClienteController;
use App\Http\Controllers\Configuracion\ProductoController;
use App\Http\Controllers\Configuracion\ProveedorController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('configuracion')
        ->name('configuracion.')
        ->group(function () {
            Route::prefix('cliente')
                ->name('cliente.')
                ->controller(ClienteController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/show/{nro_cliente}', 'show')->name('show');
                    Route::get('/edit/{nro_cliente}', 'edit')->name('edit');
                    Route::put('/update/{cliente}', 'update')->name('update');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/delete/{cliente}', 'destroy')->name('delete');
                });

            Route::prefix('proveedor')
                ->name('proveedor.')
                ->controller(ProveedorController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/show/{proveedor}', 'show')->name('show');
                    Route::get('/edit/{proveedor}', 'edit')->name('edit');
                    Route::put('/update/{proveedor}', 'update')->name('update');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/delete/{proveedor}', 'destroy')->name('delete');
                });

            Route::prefix('producto')
                ->name('producto.')
                ->controller(ProductoController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/show/{producto}', 'show')->name('show');
                    Route::get('/edit/{producto}', 'edit')->name('edit');
                    Route::put('/update/{producto}', 'update')->name('update');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/delete/{producto}', 'destroy')->name('delete');
                });
        });

});