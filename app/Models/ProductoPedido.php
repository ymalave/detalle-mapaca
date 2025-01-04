<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductoPedido extends Model
{
    use SoftDeletes;

    protected $table = 'producto_pedido';

    protected $primaryKey = 'id';

    protected $dateFormat = 'd/m/Y H:i:s';

    protected $fillable = [
        'nro_pedido',
        'cod_producto',
        'cantidad',
        'monto',
        'recibido'
    ];


}
