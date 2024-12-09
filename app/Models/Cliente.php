<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes, HasFactory;

    protected $primaryKey = 'nro_cliente';

    protected $dateFormat = 'd/m/Y H:i:s';

    protected $fillable = [
        'cedula_cliente',
        'email',
        'nro_telefono',
        'sexo',
        'nombres',
        'apellidos',
        'direccion',
    ];
}
