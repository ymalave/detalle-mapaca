<x-app-layout>
    <div>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mb-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <nav class="ml-auto">
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('dashboard') }}">Pagina Principal /</a>
                        </li>
                        <li><a class="font-medium" href="{{ route('gestion.orden_venta.index') }}">Facturación /</a>
                        </li>
                        <li class="font-medium text-primary">Editar</li>
                    </ol>
                </nav>
            </div>
        </div>

        @if ($venta->estado == 'FACTURADA')
            <div id="alert-2" class="flex items-center p-4 mb-4 m-6 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <i class="fa-solid fa-circle-info mr-2"></i>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    Las Ordenes de Ventas Facturadas no se pueden editar
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                  <span class="sr-only">Close</span>
                  <i class="fa-solid fa-xmark"></i>
                </button>
              </div>
        @endif
        <x-form class="max-w-7xl mx-auto sm:px-2 lg:px-5" method="put"
            action="{{ route('gestion.orden_venta.update', $venta) }}">
            @include('gestion.orden-venta.partials._form', [
                'type' => 'edit',
                'submit_text' => 'Actualizar',
            ])
        </x-form>
    </div>
</x-app-layout>
