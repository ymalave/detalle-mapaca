<?php

use App\Http\Controllers\Gestion\OrdenVentaController;
use App\Http\Controllers\Gestion\PedidoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('gestion/pedido')
    ->controller(PedidoController::class)
    ->group(function(){
        Route::get('/get-producto/{proveedor}', 'get_producto');
    });

Route::prefix('gestion/orden-venta')
    ->controller(OrdenVentaController::class)
    ->group(function(){
        Route::get('/get-producto/{search}', 'get_producto');
        Route::get('/get-cliente/{search}', 'get_cliente');
        Route::get('/get-producto-esp/{producto}', 'get_producto_esp');
    });


// get('/get-productos', function (Request $request) {
//     return $request->user();
// })->
