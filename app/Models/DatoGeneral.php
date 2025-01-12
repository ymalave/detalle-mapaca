<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatoGeneral extends Model
{
    protected $table = 'dato_general';

    protected $primaryKey = 'id';

    protected $dateFormat = 'd/m/Y H:i:s';

    protected $fillable = [
        'descripcion',
        'valor',
    ];
}
