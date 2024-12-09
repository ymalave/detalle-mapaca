<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Services\MenuService;

class menu extends Component
{
    public $menu;
    /**
     * Create a new component instance.
     */
    public function __construct(protected MenuService $menu_s)
    {
        $this->menu = $menu_s->build();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu');
    }
}
