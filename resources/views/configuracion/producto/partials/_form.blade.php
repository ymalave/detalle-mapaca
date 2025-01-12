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
                        error="{{ $errors->has('cod_producto') }}"
                        data-tooltip-target="tooltip-cod-producto" data-tooltip-placement="bottom"
                        readonly/>

                    @if ($type == 'store')
                    <div id="tooltip-cod-producto" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Este dato se llena automaticamente al guardar el producto
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @endif
                    @if ($errors->has('cod_producto'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cod_producto')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="nombre" error="{{ $errors->has('nombre') }}">Nombre</x-label>

                    <x-input type="text" name="nombre" x-model="nombre" class="uppercase"
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

                    <x-input type="number" name="cant_stock" x-model="cant_stock"
                        error="{{ $errors->has('cant_stock') }}"
                        data-tooltip-target="tooltip-cant-stock" data-tooltip-placement="bottom"
                        readonly/>

                    @if ($type !== 'show')
                    <div id="tooltip-cant-stock" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Este dato se calcula automaticamente según las ventas y pedidos (comienza siempre en cero)
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @endif

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
                            x-model="precio_proveedor" readonly="{{ $type == 'show' }}"
                            step="0.01"
                            @change="addPorcentaje()"
                            error="{{ $errors->has('precio_proveedor') }}" />
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
                            x-model="precio_venta" readonly="{{ $type == 'show' }}"
                            step="0.01"
                            error="{{ $errors->has('precio_venta') }}" />
                    </div>
                    @if ($errors->has('precio_venta'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('precio_venta')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>

                <x-search-proveedor type="{{ $type }}"/>

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
                type: '{{ $type }}',
                cod_producto: "{{ old('cod_producto', $producto->cod_producto ?? '') }}",
                nombre: "{{ old('nombre', $producto->nombre ?? '') }}",
                marca: "{{ old('marca', $producto->marca ?? '') }}",
                cant_stock: "{{ old('cant_stock', $producto->cant_stock ?? '') }}",
                precio_proveedor: "{{ old('precio_proveedor', $producto->precio_proveedor ?? '') }}",
                precio_venta: "{{ old('precio_venta', $producto->precio_venta ?? '') }}",
                cod_proveedor:  "{{ old('cod_proveedor', $producto->cod_proveedor ?? '') }}",
                nombre_proveedor:  "{{ old('nombre_proveedor', $producto->proveedor->nombre ?? '') }}",
                porc_desc: "{{ old('porc_desc', $porc_desc ?? 0) }}",

                proveedores: @json($proveedores ?? []),

                ...dataProveedor(),

                init(){
                    if(this.type !== 'store'){
                        const proveedor = @json($producto->proveedor ?? []);
                        this.seleccionarProveedor(proveedor);
                    }
                },

                addPorcentaje(){
                    this.precio_venta = (parseFloat(this.precio_proveedor) + (parseFloat(this.precio_proveedor) * (parseFloat(this.porc_desc) / 100))).toFixed(2);
                }

            }
        }
    </script>
@endpush
