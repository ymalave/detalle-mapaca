<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = 'menus';

    protected $dateFormat = 'd/m/Y H:i:s';

    protected $guarded = [];

    // Relaciones
    public function submenus()
    {
        return $this->hasMany(Menu::class, 'padre', 'id')->orderBy("orden");
    }
}
