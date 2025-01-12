<?php

namespace App\Http\Controllers\Configuracion;

use App\Models\DatoGeneral;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracion\DatoGeneralRequest;

class DatoGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dato_general = DatoGeneral::orderBy('id', 'ASC')->get();

        return view('configuracion.dato-general.index', compact('dato_general'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DatoGeneralRequest $request, DatoGeneral $dato_general)
    {
        try{
            DB::connection()->beginTransaction();
                $dato_general->update([
                    'valor' => $request->valor
                ]);
            DB::connection()->commit();
            return response()->json(array('msj' => 'Reistro Acuatizado con exito', 'icon' => 'success'));
        }catch(\Exception $e){
            DB::connection()->rollBack();
            Log::error($e->getMessage(), ['exception' => $e]);
            return response()->json(array('msj' => 'Ha ocurrido un error', 'icon' => 'error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
