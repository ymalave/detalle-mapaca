<x-app-layout>
    <div>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mb-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <nav class="ml-auto">
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{route('dashboard')}}">Pagina Principal /</a>
                        </li>
                        <li><a class="font-medium" href="{{route('gestion.orden_venta.index')}}">Orden de Venta /</a></li>
                        <li class="font-medium text-primary">Nuevo</li>
                    </ol>
                </nav>
            </div>
        </div>
        <x-form class="max-w-7xl mx-auto sm:px-2 lg:px-5" method="post" action="{{ route('gestion.orden_venta.store') }}">
            @include('gestion.orden-venta.partials._form', ['type' => 'store', 'submit_text' => 'Guardar'])
        </x-form>
    </div>
</x-app-layout>
