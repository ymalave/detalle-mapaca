<?php

namespace App\Http\Controllers\Gestion;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductoPedido;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Gestion\PedidoRequest;

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
        $pedido = new Pedido();
        $pedido->fecha_solicitud = now()->format('Y-m-d H:i');

        $proveedores = Proveedor::select('cod_proveedor', 'nombre as nombre_proveedor')->get();
        return view('gestion.pedido.create', compact('proveedores', 'pedido'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PedidoRequest $request)
    {
        // dd($request);
        try{
            DB::connection()->beginTransaction();
            $producto_pedido = $request->producto_pedido;
            $pedido = Pedido::create([
                    'cod_proveedor' => $request->cod_proveedor,
                    'fecha_solicitud' => $request->fecha_solicitud,
                    'fecha_recepcion' => $request->fecha_recepcion,
                    'cerrado' => false
                ]);

            if(isset($producto_pedido)){
                foreach($producto_pedido as $key => $item){
                    ProductoPedido::create([
                        'nro_pedido' => $pedido->nro_pedido,
                        'cod_producto' => $item['cod_producto'],
                        'cantidad' => $item['cantidad'],
                        'monto' => $item['monto'],
                        'recibido' => false
                    ]);
                }
            }

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('gestion.pedido.index');
        }catch(\Exception $e){
            DB::connection()->rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            alert()->error('Transacción Fallida: ' . Str::limit($e->getMessage(), 200));
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        $producto_pedido = $pedido->producto_pedido;

        $producto_pedido->map(function($item, $key){
            $item->nombre_producto = Producto::where('cod_producto', $item->cod_producto)->first()?->nombre;
            $item->recibido = $item->recibido == true ? 'SI': 'NO';
        });
        return view('gestion.pedido.show', compact('pedido', 'producto_pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        $producto_pedido = $pedido->producto_pedido;

        $producto_pedido->map(function($item, $key){
            $item->nombre_producto = Producto::where('cod_producto', $item->cod_producto)->first()?->nombre;
        });
        return view('gestion.pedido.edit', compact('pedido', 'producto_pedido'));
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

    public function get_producto(Proveedor $proveedor){
        $productos = $proveedor->productos;

        $productos->map(function($item, $key){
            $item->nombre_producto = $item->nombre;
        });

        return response()->json($productos->select('cod_producto', 'precio_proveedor', 'nombre_producto'));
    }
}
