<?php

namespace App\Http\Controllers\Gestion;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Gestion\OrdenVentaRequest;
use App\Models\DatoGeneral;
use App\Models\VentaDetalle;

class OrdenVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::join('clientes as c', 'venta.nro_cliente', '=', 'c.nro_cliente')
                    ->selectRaw("venta.nro_venta, venta.monto_total, to_char(venta.created_at, 'DD/MM/YYYY') as fecha, concat(c.nombres, ' ', c.apellidos) as nombre_cliente")
                    ->orderBy('venta.nro_venta', 'DESC')
                    ->get();

        return view('gestion.orden-venta.index', compact('ventas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        $valor_dolar = (float) DatoGeneral::find(1)->valor;

        return view('gestion.orden-venta.create', compact('user', 'valor_dolar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrdenVentaRequest $request)
    {
        try{
            DB::connection()->beginTransaction();
            $venta_detalle = $request->venta_detalle;
            $venta = Venta::create([
                    'nro_cliente' => $request->nro_cliente,
                    'monto_total' => $request->monto_total,
                    'monto_total_bs' => $request->monto_total_bs,
                    'usuario' => auth()->user()->id,
                ]);

            if(isset($venta_detalle)){
                foreach($venta_detalle as $key => $item){
                    $producto = Producto::find($item['cod_producto']);

                    $cant_now = (int)$producto->cant_stock - (int)$item['cantidad'];

                    if($cant_now < 0){
                        DB::connection()->rollBack();
                        alert()->error('No hay suficiente '. $item['nombre_producto']. ' en stock');
                        return redirect()->back()->withInput();
                    }else{
                        $producto->cant_stock = $cant_now;
                        $producto->save();
                    }

                    VentaDetalle::create([
                        'nro_venta' => $venta->nro_venta,
                        'cod_producto' => $item['cod_producto'],
                        'cantidad' => $item['cantidad'],
                        'monto' => $item['monto'],
                        'monto_bs' => $item['monto_bs'],
                    ]);
                }
            }

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('gestion.orden_venta.index');
        }catch(\Exception $e){
            DB::connection()->rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            alert()->error('Transacción Fallida');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        $cliente = $venta->cliente;

        $user = $venta->user;

        $venta_detalle = $venta->productos;

        $venta_detalle->map(function($item, $key){
            $item->nombre_producto = Producto::where('cod_producto', $item->cod_producto)->first()?->nombre;
        });
        return view('gestion.orden-venta.show', compact('venta', 'cliente', 'user', 'venta_detalle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        $cliente = $venta->cliente;

        $user = $venta->user;

        $venta_detalle = $venta->productos;

        $venta_detalle->map(function($item, $key){
            $item->nombre_producto = Producto::where('cod_producto', $item->cod_producto)->first()?->nombre;
        });
        return view('gestion.orden-venta.edit', compact('venta', 'cliente', 'user', 'venta_detalle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrdenVentaRequest $request, Venta $venta)
    {
        try{
            DB::connection()->beginTransaction();
            $venta_detalle = $request->venta_detalle;
            // if($venta->estado == 'FACTURADA'){
            //     alert()->error('La Venta esta facturada, no se puede actualizar');
            //     return redirect()->back()->withInput();
            // }
            $venta->update([
                    'monto_total' => $request->monto_total,
                    'monto_total_bs' => $request->monto_total_bs,
                    'usuario' => auth()->user()->id,
                ]);

            $producto_ped_ant = $venta->productos;
            if(isset($venta_detalle)){
                foreach($venta_detalle as $key => $item){
                    $producto = Producto::find($item['cod_producto']);

                    $cant_now = (int)$producto->cant_stock - (int)$item['cantidad'];

                    if($cant_now < 0){
                        DB::connection()->rollBack();
                        alert()->error('No hay suficiente '. $item['nombre_producto']. ' en stock');
                        return redirect()->back()->withInput();
                    }else{
                        $producto->cant_stock = $cant_now;
                        $producto->save();
                    }


                    VentaDetalle::updateOrCreate(
                        [
                            'nro_venta' => $venta->nro_venta,
                            'cod_producto' => $item['cod_producto'],
                        ],
                        [
                            'cantidad' => $item['cantidad'],
                            'monto' => $item['monto'],
                            'monto_bs' => $item['monto_bs'],
                        ]
                    );


                }
            }

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('gestion.orden_venta.index');
        }catch(\Exception $e){
            DB::connection()->rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            alert()->error('Transacción Fallida');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function get_producto($search){
        $producto = Producto::where('cod_producto', 'ILIKE', '%'.$search.'%')->orWhere('nombre', 'ILIKE', '%'.$search.'%')
                    ->select('cod_producto', 'precio_venta', 'nombre as nombre_producto')->get();


        return response()->json($producto);
    }
    public function get_producto_esp(Producto $producto){

        return response()->json($producto);
    }

    public function get_cliente($search){
        $cliente = Cliente::where('cedula_cliente', $search)
                    ->selectRaw("nro_cliente, cedula_cliente, concat(nombres, ' ', apellidos) as nombre_cliente")
                    ->first();

        return response()->json($cliente);
    }
}
