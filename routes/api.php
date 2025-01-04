<?php

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


// get('/get-productos', function (Request $request) {
//     return $request->user();
// })->
