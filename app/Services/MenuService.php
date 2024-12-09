<?php

namespace App\Services;

use App\Models\Menu;
use Spatie\Navigation\Navigation;
use Spatie\Navigation\Section;

class MenuService
{
    private function recursiveMenu($menus, $navigation)
    {
        foreach ($menus as $menu) {
            //Se valida si el usuario logueado tiene el permiso para visualizar el item
            $navigation->addIf(
                auth()->user() &&
                (! empty($menu->id_permission) && auth()->user()->hasPermissionTo($menu->id_permission)),
                $menu->nombre,
                $menu->url_destino,
                function (Section $section) use ($menu) {
                    $section->attributes([
                        'icon' => $menu->icono,
                        'descripcion' => $menu->descripcion,
                    ]);

                    $this->recursiveMenu($menu->submenus, $section);
                });
        }
    }

    public function build()
    {
        // Obtener los datos del menú
        $menus = Menu::query()
            ->with('submenus')
            ->where([
                'activo' => true,
                'padre' => 0,
            ])
            ->orderBy('orden', 'ASC')
            ->get();
        // Crear una nueva instancia
        $navigation = Navigation::make();
        foreach ($menus as $menu) {
            $navigation->addIf(
                auth()->user() &&
                (! empty($menu->id_permission) && auth()->user()->hasPermissionTo($menu->id_permission)),
                $menu->nombre,
                $menu->url_destino,
                function (Section $section) use ($menu) {
                    $section->attributes([
                        'icon' => $menu->icono,
                        'descripcion' => $menu->descripcion,
                    ]);
                    $this->recursiveMenu($menu->submenus, $section);
                });
        }

        return $navigation->tree();
    }
}
