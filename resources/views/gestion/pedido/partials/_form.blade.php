<div x-data="data()">
    <div class="w-full p-4 bg-white border-t-4 border-indigo-800 rounded-lg shadow-lg sm:p-8 dark:bg-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Orden de Compra</h5>
        </div>
        <div class="flow-root">
            <div class="grid gap-4 mb-6 md:grid-cols-3">
                <div>
                    <x-label for="nro_pedido" error="{{ $errors->has('nro_pedido') }}">
                        Nro. Pedido
                    </x-label>
                    <x-input type="text" name="nro_pedido" x-model="nro_pedido" class="uppercase"
                        error="{{ $errors->has('nro_pedido') }}"
                        data-tooltip-target="tooltip-cod-producto" data-tooltip-placement="bottom"
                        readonly/>

                    @if ($type == 'store')
                    <div id="tooltip-cod-producto" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Este dato se llena automaticamente al guardar el producto
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @endif
                    @if ($errors->has('nro_pedido'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('nro_pedido')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <x-search-proveedor type="{{ $type }}"/>
                <div>
                    <x-label for="fecha_solicitud" error="{{ $errors->has('fecha_solicitud') }}">Fecha Solicitud</x-label>

                    <x-input type="datetime-local" name="fecha_solicitud" x-model="fecha_solicitud"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('fecha_solicitud') }}" />

                    @if ($errors->has('fecha_solicitud'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('fecha_solicitud')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="fecha_recepcion" error="{{ $errors->has('fecha_recepcion') }}">Fecha Recepcion</x-label>

                    <x-input type="datetime-local" name="fecha_recepcion" x-model="fecha_recepcion" readonly="{{ $type == 'show' }}"
                        error="{{ $errors->has('fecha_recepcion') }}" />

                    @if ($errors->has('fecha_recepcion'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('fecha_recepcion')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="cerrado" error="{{ $errors->has('cerrado') }}">Cerrado</x-label>

                    <label class="inline-flex items-center mb-5 cursor-pointer">
                        <x-input type="checkbox" x-model="cerrado" class="sr-only peer"  />
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>

                    @if ($type !== 'show')
                    <div id="tooltip-cant-stock" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Este dato se calcula automaticamente según las ventas y pedidos (comienza siempre en cero)
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @endif

                    @if ($errors->has('cerrado'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cerrado')
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
                type: '{{ $type }}',
                nro_pedido: "{{ old('nro_pedido', $pedido->nro_pedido ?? '') }}",
                fecha_solicitud: "{{ old('fecha_solicitud', $pedido->fecha_solicitud ?? '') }}",
                fecha_recepcion: "{{ old('fecha_recepcion', $pedido->fecha_recepcion ?? '') }}",
                cerrado: @json(@old('cerrado', $pedido->cerrado ?? false)),
                cod_proveedor:  "{{ old('cod_proveedor', $pedido->cod_proveedor ?? '') }}",
                nombre_proveedor:  "{{ old('nombre_proveedor', $pedido->proveedor->nombre ?? '') }}",

                proveedores: @json($proveedores ?? []),

                ...dataProveedor(),

                init(){
                    if(this.type !== 'store'){
                        const proveedor = @json($pedido->proveedor ?? []);
                        this.seleccionarProveedor(proveedor);
                    }
                }
            }
        }
    </script>
@endpush
