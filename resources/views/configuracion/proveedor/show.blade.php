<x-app-layout>
    <div>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mb-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <nav class="ml-auto">
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{route('dashboard')}}">Pagina Principal /</a>
                        </li>
                        <li><a class="font-medium" href="{{route('configuracion.proveedor.index')}}">Proveedores /</a></li>
                        <li class="font-medium text-primary">Visualización</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-5">
            @include('configuracion.proveedor.partials._form', ['type' => 'show', 'submit_text' => ''])
        </div>
    </div>
</x-app-layout>
