<div x-data="data()">
    <div class="w-full p-4 bg-white border-t-4 border-indigo-800 rounded-lg shadow-lg sm:p-8 dark:bg-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Producto</h5>
        </div>
        <div class="flow-root">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-label for="cod_producto" error="{{ $errors->has('cod_producto') }}">
                        Codigo del producto
                    </x-label>
                    <x-input type="text" name="cod_producto" x-model="cod_producto" class="uppercase"
                        readonly="{{ $type !== 'store' }}" error="{{ $errors->has('cod_producto') }}" />

                    @if ($errors->has('cod_producto'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cod_producto')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="proveedor[nombre]" error="{{ $errors->has('nombre') }}">Nombre</x-label>

                    <x-input type="text" name="proveedor[nombre]" x-model="nombre" class="uppercase"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('nombre') }}" />

                    @if ($errors->has('nombre'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('nombre')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="marca" error="{{ $errors->has('marca') }}">Marca</x-label>

                    <x-input type="text" name="marca" x-model="marca" readonly="{{ $type == 'show' }}"
                        error="{{ $errors->has('marca') }}" />

                    @if ($errors->has('marca'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('marca')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="cant_stock" error="{{ $errors->has('cant_stock') }}">Cant. Stock</x-label>

                    <x-input type="number" name="cant_stock" x-model="cant_stock" readonly="{{ $type == 'show' }}"
                        error="{{ $errors->has('cant_stock') }}" />

                    @if ($errors->has('cant_stock'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cant_stock')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>

                <div>
                    <x-label for="precio_proveedor" error="{{ $errors->has('precio_proveedor') }}">Precio Proveedor</x-label>
                    <div class="flex">
                        <span
                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </span>
                        <x-input type="number" name="precio_proveedor" class="rounded-none rounded-e-lg"
                            x-model="precio_proveedor" x-mask:dynamic="$money($input)" readonly="{{ $type == 'show' }}"
                            error="{{ $errors->has('nombre') }}" />
                    </div>
                    @if ($errors->has('precio_proveedor'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('precio_proveedor')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>

                <div>
                    <x-label for="precio_venta" error="{{ $errors->has('precio_venta') }}">Precio Venta</x-label>
                    <div class="flex">
                        <span
                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </span>
                        <x-input type="number" name="precio_venta" class="rounded-none rounded-e-lg"
                            x-model="precio_venta" x-mask:dynamic="$money($input)" readonly="{{ $type == 'show' }}"
                            error="{{ $errors->has('nombre') }}" />
                    </div>
                    @if ($errors->has('precio_venta'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('precio_venta')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>

                <div>
                    <x-label for="cod_proveedor"
                        error="{{ $errors->has('cod_proveedor') }}">Codigo de Proveedor</x-label>

                    <x-input type="text" name="cod_proveedor" x-model="cod_proveedor"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('cod_proveedor') }}" />

                    @if ($errors->has('cod_proveedor'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cod_proveedor')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="nombre_proveedor"
                        error="{{ $errors->has('nombre_proveedor') }}">Nombre Proveedor</x-label>

                    <x-input type="text" name="nombre_proveedor" x-model="nombre_proveedor"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('nombre_proveedor') }}" />

                    @if ($errors->has('nombre_proveedor'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('nombre_proveedor')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
            </div>

            @if ($type !== 'show')
                <div class="flex justify-end ml-auto">
                    <x-button style="default">{{ $submit_text }}</x-button>
                </div>
            @endif
        </div>
    </div>
</div>

@push('js')
    <script>
        function data() {
            return {
                cod_producto: "{{ old('cod_producto', $producto->cod_producto ?? '') }}",
                nombre: "{{ old('nombre', $producto->nombre ?? '') }}",
                marca: "{{ old('marca', $producto->marca ?? '') }}",
                cant_stock: "{{ old('cant_stock', $producto->cant_stock ?? '') }}",
                precio_venta: "{{ old('precio_venta', $producto->precio_venta ?? '') }}",
                precio_proveedor: "{{ old('precio_proveedor', $producto->precio_proveedor ?? '') }}",
                cod_proveedor:  "{{ old('cod_proveedor', $producto->cod_proveedor ?? '') }}",
                nombre_proveedor:  "{{ old('nombre_proveedor', $producto->proveedor->nombre ?? '') }}",
            }
        }
    </script>
@endpush
