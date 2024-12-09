<?php

namespace App\Http\Controllers\Configuracion;

use App\Models\Proveedor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracion\ProveedorRequest;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::get();
        return view('configuracion.proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configuracion.proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProveedorRequest $request)
    {
        try{
            DB::connection()->beginTransaction();
            $form = $request->proveedor;

            Proveedor::create($form);

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('configuracion.proveedor.index');
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
    public function show(Proveedor $proveedor)
    {
        return view('configuracion.proveedor.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        return view('configuracion.proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProveedorRequest $request, Proveedor $proveedor)
    {
        try{
            DB::connection()->beginTransaction();
            $form = collect($request->proveedor);

            $proveedor->update($form->except('rif')->toArray());

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('configuracion.proveedor.index');
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
    public function destroy(Proveedor $proveedor)
    {
        try{
            DB::connection()->beginTransaction();

            $proveedor->delete();

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('configuracion.proveedor.index');
        }catch(\Exception $e){
            DB::connection()->rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            alert()->error('Transacción Fallida: ' . Str::limit($e->getMessage(), 200));
            return redirect()->back()->withInput();
        }
    }
}
