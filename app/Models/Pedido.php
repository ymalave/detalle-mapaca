<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'pedido';

    protected $primaryKey = 'nro_pedido';

    protected $dateFormat = 'd/m/Y H:i:s';

    protected $fillable = [
        'nro_pedido',
        'cod_proveedor',
        'fecha_solicitud',
        'fecha_recepcion',
        'cerrado'
    ];

    public function proveedor(){
        return $this->hasOne(Proveedor::class, 'cod_proveedor', 'cod_proveedor');
    }

    public function producto_pedido(){
        return $this->hasMany(ProductoPedido::class, 'nro_pedido', 'nro_pedido')->orderBy('id', 'ASC');
    }
}
