<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VentaDetalle extends Model
{
    use SoftDeletes;

    protected $table = 'venta_detalle';

    protected $dateFormat = 'd/m/Y H:i:s';

    protected $fillable = [
        'id',
        'nro_venta',
        'cod_producto',
        'cantidad',
        'monto',
    ];
}
