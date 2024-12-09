<?php

namespace App\Http\Controllers\Configuracion;

use App\Models\Cliente;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracion\ClienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::get();
        return view('configuracion.cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configuracion.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteRequest $request)
    {
        try{
            DB::connection()->beginTransaction();
            $form = $request->cliente;

            Cliente::create($form);

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('configuracion.cliente.index');
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
    public function show(Cliente $nro_cliente)
    {
        $cliente = $nro_cliente;
        return view('configuracion.cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $nro_cliente)
    {
        $cliente = $nro_cliente;
        return view('configuracion.cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        try{
            DB::connection()->beginTransaction();
            $form = $request->cliente;

            $cliente->update($form);

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('configuracion.cliente.index');
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
    public function destroy(Cliente $cliente)
    {
        try{
            DB::connection()->beginTransaction();

            $cliente->delete();

            DB::connection()->commit();
            alert()->success('Transacción exitosa');
            return redirect()->route('configuracion.cliente.index');
        }catch(\Exception $e){
            DB::connection()->rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            alert()->error('Transacción Fallida: ' . Str::limit($e->getMessage(), 200));
            return redirect()->back()->withInput();
        }
    }
}
