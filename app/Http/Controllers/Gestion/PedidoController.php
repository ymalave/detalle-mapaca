<?php

namespace App\Http\Controllers\Gestion;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::select('pedido.nro_pedido', 'pedido.cod_proveedor', 'p.nombre', DB::raw('to_char(pedido.fecha_solicitud, \'DD/MM/YYYY\') as fecha_solicitud'), 'pedido.cerrado')
                        ->join('proveedores as p', 'pedido.cod_proveedor', '=', 'p.cod_proveedor')->get();
        return view('gestion.pedido.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        return view('gestion.pedido.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
