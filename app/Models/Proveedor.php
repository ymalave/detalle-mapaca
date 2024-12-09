<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proveedor extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'proveedores';

    protected $primaryKey = 'cod_proveedor';

    protected $dateFormat = 'd/m/Y H:i:s';

    protected $fillable = [
        'rif',
        'nombre',
        'direccion',
        'telefono',
        'email',
        'cedula_representante',
        'nombre_representante',
    ];
}
