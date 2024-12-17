<?php

namespace App\Http\Controllers\Configuracion;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracion\ProductoRequest;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::get();
        return view('configuracion.producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::select('cod_proveedor', 'nombre as nombre_proveedor')->get();
        return view('configuracion.producto.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        try{
            DB::connection()->beginTransaction();
            $form = $request->except(['cod_producto', 'nombre_proveedor', 'cant_stock']);

            Producto::create($form);

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('configuracion.producto.index');
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
    public function show(Producto $producto)
    {
        return view('configuracion.producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $proveedores = Proveedor::select('cod_proveedor', 'nombre as nombre_proveedor')->get();
        return view('configuracion.producto.edit', compact('producto', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
        try{
            DB::connection()->beginTransaction();
            $form = $request->except(['cod_producto', 'nombre_proveedor', 'cant_stock']);

            $producto->update($form);

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('configuracion.producto.index');
        }catch(\Exception $e){
            DB::connection()->rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            alert()->error('Transacción Fallida: ' . Str::limit($e->getMessage(), 200));
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        try{
            DB::connection()->beginTransaction();

            $producto->delete();

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('configuracion.producto.index');
        }catch(\Exception $e){
            DB::connection()->rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            alert()->error('Transacción Fallida: ' . Str::limit($e->getMessage(), 200));
            return redirect()->back()->withInput();
        }
    }
}
