<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $pedido_pendiente = Pedido::select('nro_pedido', 'cod_proveedor', DB::raw('to_char(fecha_solicitud, \'DD/MM/YYYY\') as fecha_solicitud'))
                            ->where('cerrado', false)->get();

        $sub_week = now()->subWeek();

        while($sub_week < now()){
            $ventas_semana[$sub_week->format('d/m/Y')] = Venta::whereDate('created_at', $sub_week)->count();

            $sub_week = $sub_week->addDay();
        }

        return view('dashboard', compact('ventas_semana', 'pedido_pendiente'));
    }
}
