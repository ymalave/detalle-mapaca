<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchProveedor extends Component
{
    public $type;
    /**
     * Create a new component instance.
     */
    public function __construct($type = null)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-proveedor');
    }
}
