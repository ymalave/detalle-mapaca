<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use SoftDeletes;

    protected $table = 'venta';

    protected $primaryKey = 'nro_venta';

    protected $dateFormat = 'd/m/Y H:i:s';

    protected $fillable = [
        'nro_venta',
        'nro_cliente',
        'monto_total',
        'monto_total_bs',
        'usuario',
    ];

    public function cliente(){
        return $this->hasOne(Cliente::class, 'nro_cliente', 'nro_cliente')->selectRaw("nro_cliente, cedula_cliente, concat(nombres, ' ', apellidos) as nombre_cliente");
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'usuario');
    }

    public function productos(){
        return $this->hasMany(VentaDetalle::class, 'nro_venta', 'nro_venta');
    }
}
