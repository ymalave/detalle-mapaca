<x-app-layout>
    <div>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mb-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <nav class="ml-auto">
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{route('dashboard')}}">Pagina Principal /</a>
                        </li>
                        <li><a class="font-medium" href="{{route('configuracion.producto.index')}}">Productos /</a></li>
                        <li class="font-medium text-primary">Editar</li>
                    </ol>
                </nav>
            </div>
        </div>


        <x-form class="max-w-7xl mx-auto sm:px-2 lg:px-5" method="put" action="{{ route('configuracion.producto.update', $producto) }}">
            @include('configuracion.producto.partials._form', ['type' => 'edit', 'submit_text' => 'Actualizar'])
        </x-form>
    </div>
</x-app-layout>
