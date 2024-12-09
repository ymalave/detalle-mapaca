<?php

namespace App\Models;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'producto';

    protected $primaryKey = 'cod_producto';

    protected $dateFormat = 'd/m/Y H:i:s';

    protected $fillable = [
        'cod_producto',
        'cod_proveedor',
        'cant_stock',
        'precio_venta',
        'precio_proveedor',
        'nombre',
        'marca'
    ];

    public function proveedor(){
        return $this->hasOne(Proveedor::class, 'cod_proveedor', 'cod_proveedor');
    }
}
