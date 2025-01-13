<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <div class="block  p-6 bg-indigo-800 border border-gray-200 rounded-lg shadow hover:bg-indigo-700 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white dark:text-white">Existen {{ $pedido_pendiente->count() }} ordenes de compra pendientes</h5>
                        <a href="{{ route('gestion.pedido.index') }}" class="font-normal text-white dark:text-gray-400">Ir a detalle <i class="ml-1 fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="mt-2 p-5">
                        <div class="overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-50 uppercase bg-indigo-800 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Proveedor
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Fecha Solicitud
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pedido_pendiente as $item)
                                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <td class="px-6 py-4">
                                                    <span>{{ $item->proveedor->nombre }}</span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span>{{ $item->fecha_solicitud }}</span>
                                                </td>

                                            </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="block  p-6 bg-indigo-800 border border-gray-200 rounded-lg shadow hover:bg-indigo-700 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white dark:text-white">Se han registrado {{ array_sum($ventas_semana) }} ventas esta semana</h5>
                        <a href="{{ route('gestion.orden_venta.index') }}" class="font-normal text-white dark:text-gray-400">Ir a detalle <i class="ml-1 fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="mt-2 p-5">
                        <div class="overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-50 uppercase bg-indigo-800 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Fecha
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Cantidad
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ventas_semana as $key => $item)
                                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <td class="px-6 py-4">
                                                    <span>{{ $key }}</span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span>{{ $item }}</span>
                                                </td>

                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</x-app-layout>
