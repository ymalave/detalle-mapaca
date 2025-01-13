<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Gestion\PedidoController;
use App\Http\Controllers\Gestion\OrdenVentaController;
use App\Http\Controllers\Configuracion\ClienteController;
use App\Http\Controllers\Configuracion\ProductoController;
use App\Http\Controllers\Configuracion\ProveedorController;
use App\Http\Controllers\Configuracion\DatoGeneralController;

Route::get('/', function () {
    $marcas = [
        'solita',
        'sharpie',
        'pointer',
        'pentel',
        'paper-mate',
        'ok',
        'maped',
        'norma',
        'kores',
        'faber-castell',
        'crisvi',
        'crayola',
        'barrilito'
    ];
    shuffle($marcas);
    return view('welcome', compact('marcas'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::controller(DashboardController::class)
        ->prefix('dashboard')
        ->group(function () {
            Route::get('/', 'index')->name('dashboard')->middleware('can:permiso_general');
        });

    Route::prefix('configuracion')
        ->name('configuracion.')
        ->group(function () {
            Route::prefix('cliente')
                ->name('cliente.')
                ->controller(ClienteController::class)
                ->group(function () {
                    Route::get('/', 'index')->middleware('can:cliente.index')->name('index');
                    Route::get('/show/{nro_cliente}', 'show')->middleware('can:cliente.show')->name('show');
                    Route::get('/edit/{nro_cliente}', 'edit')->middleware('can:cliente.edit')->name('edit');
                    Route::put('/update/{cliente}', 'update')->middleware('can:cliente.edit')->name('update');
                    Route::get('/create', 'create')->middleware('can:cliente.create')->name('create');
                    Route::post('/store', 'store')->middleware('can:cliente.create')->name('store');
                    Route::get('/delete/{cliente}', 'destroy')->middleware('can:cliente.delete')->name('delete');
                });

            Route::prefix('proveedor')
                ->name('proveedor.')
                ->controller(ProveedorController::class)
                ->group(function () {
                    Route::get('/', 'index')->middleware('can:proveedor.index')->name('index');
                    Route::get('/show/{proveedor}', 'show')->middleware('can:proveedor.show')->name('show');
                    Route::get('/edit/{proveedor}', 'edit')->middleware('can:proveedor.edit')->name('edit');
                    Route::put('/update/{proveedor}', 'update')->middleware('can:proveedor.edit')->name('update');
                    Route::get('/create', 'create')->middleware('can:proveedor.create')->name('create');
                    Route::post('/store', 'store')->middleware('can:proveedor.create')->name('store');
                    Route::get('/delete/{proveedor}', 'destroy')->middleware('can:proveedor.delete')->name('delete');
                });

            Route::prefix('producto')
                ->name('producto.')
                ->controller(ProductoController::class)
                ->group(function () {
                    Route::get('/', 'index')->middleware('can:producto.index')->name('index');
                    Route::get('/show/{producto}', 'show')->middleware('can:producto.show')->name('show');
                    Route::get('/edit/{producto}', 'edit')->middleware('can:producto.edit')->name('edit');
                    Route::put('/update/{producto}', 'update')->middleware('can:producto.edit')->name('update');
                    Route::get('/create', 'create')->middleware('can:producto.create')->name('create');
                    Route::post('/store', 'store')->middleware('can:producto.create')->name('store');
                    Route::get('/delete/{producto}', 'destroy')->middleware('can:producto.delete')->name('delete');
                });

            Route::prefix('dato-general')
                ->name('dato_general.')
                ->controller(DatoGeneralController::class)
                ->group(function () {
                    Route::get('/', 'index')->middleware('can:dato_general.index')->name('index');
                    Route::post('/update/{dato_general}', 'update')->middleware('can:dato_general.update')->name('update');
                });
        });


    Route::prefix('gestion')
    ->name('gestion.')
    ->group(function () {
        Route::prefix('pedido')
            ->name('pedido.')
            ->controller(PedidoController::class)
            ->group(function () {
                Route::get('/', 'index')->middleware('can:orden_compra.index')->name('index');
                Route::get('/show/{pedido}', 'show')->middleware('can:orden_compra.show')->name('show');
                Route::get('/edit/{pedido}', 'edit')->middleware('can:orden_compra.edit')->name('edit');
                Route::put('/update/{pedido}', 'update')->middleware('can:orden_compra.edit')->name('update');
                Route::get('/create', 'create')->middleware('can:orden_compra.create')->name('create');
                Route::post('/store', 'store')->middleware('can:orden_compra.create')->name('store');
            });

        Route::prefix('orden-venta')
            ->name('orden_venta.')
            ->controller(OrdenVentaController::class)
            ->group(function () {
                Route::get('/', 'index')->middleware('can:facturacion.index')->name('index');
                Route::get('/show/{venta}', 'show')->middleware('can:facturacion.show')->name('show');
                Route::get('/edit/{venta}', 'edit')->middleware('can:facturacion.edit')->name('edit');
                Route::put('/update/{venta}', 'update')->middleware('can:facturacion.edit')->name('update');
                Route::get('/create', 'create')->middleware('can:facturacion.create')->name('create');
                Route::post('/store', 'store')->middleware('can:facturacion.create')->name('store');
            });
        });

});
