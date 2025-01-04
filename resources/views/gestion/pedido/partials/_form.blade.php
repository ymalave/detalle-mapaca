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
                        data-tooltip-target="tooltip-cod-pedido" data-tooltip-placement="bottom"
                        readonly/>

                    @if ($type == 'store')
                    <div id="tooltip-cod-pedido" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Este dato se llena automaticamente al guardar el pedido
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
                <x-search-proveedor type="{{ $type }}"/>
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

            @if ($type != 'show')
            <div class="overflow-x-auto shadow-md sm:rounded-lg mb-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                    <thead class="text-xs text-gray-50 uppercase bg-indigo-800 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Producto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Add</span>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div>
                                    <div class="w-full" x-show="selectedProducto >= 0">
                                        <div class="flex">
                                            <x-input  name="nombre_producto" x-bind:style="bloquear_producto"
                                                class="rounded-none rounded-s-lg"
                                                x-bind:class="type == 'show' ? 'rounded-e-lg' : ''"
                                                error="{{ $errors->has('nombre_producto') }}"
                                                x-model="nombre_producto" />
                                            <x-input name="cod_producto" type="hidden" x-model="selectedProducto" />
                                            @if ($type != 'show')
                                                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 border-gray-300 border-s-0 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600"
                                                    @click="clearInputProducto()">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                            @endif

                                            <template x-if="errors['nombre_producto']">
                                                <div class="text-red-500 text-sm" x-text="errors['nombre_producto']"></div>
                                            </template>
                                        </div>
                                    </div>
                                    <div class="w-full" x-show="selectedProducto < 0">
                                        <x-input type="text"  error="{{ $errors->has('nombre_producto') }}"
                                            x-model="search_producto" placeholder="Buscar producto" />
                                        <template x-if="errors['nombre_producto']">
                                            <div class="text-red-500 text-sm" x-text="errors['nombre_producto']"></div>
                                        </template>
                                    </div>
                                </div>

                                <div class="flex-grow overflow-y-20 absolute">
                                    <template x-if="search_producto.length > 0 && search_producto.length < 3">
                                        <a class="list-group-item list-group-item-action">
                                            <span>Ingrese 3 letras o más</span>
                                        </a>
                                    </template>

                                    <template x-if="search_producto.length > 2 && productos.length == 0">
                                        <a class="w-full col-12">
                                            No se encontraron resultados
                                        </a>
                                    </template>

                                    <template x-if="productos.length > 0">
                                        <template x-for="producto in filterProducto()" :key="producto.cod_producto">
                                            <a class="cursor-pointer block min-w-50 p-2 text-left bg-white hover:bg-gray-200"
                                                @click="seleccionarproducto(producto)">
                                                <span x-text="producto.nombre_producto" class="relative text-gray-800"></span>
                                            </a>
                                        </template>
                                    </template>

                                </div>
                            </th>
                            <td class="px-6 py-4">
                                <x-input name="cant_pedido" type="nomber"
                                    @blur="calcular_precio()"
                                    error="{{ $errors->has('cant_pedido') }}"
                                    x-model="cant_pedido" placeholder="Cantidad pedido" />
                            </td>
                            <td class="px-6 py-4">
                                <x-input name="precio_pedido" type="number" step="0.01"
                                    error="{{ $errors->has('precio_pedido') }}"
                                    x-model="precio_pedido" placeholder="Precio" readonly/>
                            </td>
                            <td>
                                <x-button class="text-xs font-medium text-center" style="indigo" @click.prevent="addProducto()"><i class="fa-solid fa-plus"></i></x-button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            @endif

            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-50 uppercase bg-indigo-800 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Producto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Recibido
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-if="producto_pedido.length > 0">
                            <template x-for="(item, key) in producto_pedido" key="key">
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <span x-text="item.nombre_producto"></span>
                                        <x-input type="hidden" x-bind:name="`producto_pedido[${key}][cod_producto]`" x-model="item.cod_producto" />
                                        <x-input type="hidden" x-bind:name="`producto_pedido[${key}][nombre_producto]`" x-model="item.nombre_producto" />
                                    </th>
                                    <td class="px-6 py-4">
                                        <span x-text="item.cantidad"></span>
                                        <x-input type="hidden" x-bind:name="`producto_pedido[${key}][cantidad]`" x-model="item.cantidad" />
                                    </td>
                                    <td class="px-6 py-4">
                                        <span x-text="item.monto"></span>
                                        <x-input type="hidden"  x-bind:name="`producto_pedido[${key}][monto]`" x-model="item.monto" />
                                    </td>
                                    <td class="px-6 py-4">
                                        <span x-text="item.recibido"></span>
                                        <x-input type="hidden"  x-bind:name="`producto_pedido[${key}][recibido]`" x-model="item.recibido" />
                                    </td>
                                </tr>
                            </template>
                        </template>

                        <template x-if="producto_pedido.length <= 0">
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="text-center px-6 py-4 text-gray-900" colspan="4">
                                    <span>No se encontraron registros</span>
                                </td>

                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

        </div>

        @if ($type !== 'show')
            <div class="w-full flex justify-end ml-auto pt-4">
                <x-button style="default">{{ $submit_text }}</x-button>
            </div>
        @endif
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
                nombre_producto:  "{{ old('nombre_producto', $pedido->proveedor->nombre ?? '') }}",

                proveedores: @json($proveedores ?? []),

                productos: @json(@old('productos', $productos ?? [])),
                producto_pedido: @json(@old('producto_pedido', $producto_pedido ?? [])),

                selectedProducto: -1,
                search_producto: '',
                bloquear_producto: '',
                nombre_producto: '',
                precio_producto: null,
                cant_pedido: null,
                precio_pedido: null,

                ...dataProveedor(),

                init(){
                    if(this.type !== 'store'){
                        const proveedor = @json($pedido->proveedor ?? []);
                        this.seleccionarProveedor(proveedor);
                    }

                    this.$watch('cod_proveedor', (value) => {
                        if (value) {
                            this.onProveedorChange(); // Call the function when selectedProveedor changes
                        }
                    });
                },


                onProveedorChange(){
                    const route = `{{ env('APP_URL') }}/api/gestion/pedido/get-producto/${this.cod_proveedor}`;

                    this.clearInputProducto();
                    fetch(route)
                    .then(response => response.json())
                    .then(data => {
                        this.productos = data;
                    })
                },

                filterProducto(){
                    if (this.search_producto && this.search_producto.length > 2) {
                        return this.productos.filter(producto => {
                            return producto.cod_producto.toString().toLowerCase().includes(this.search_producto.toLowerCase()) ||
                                producto.nombre_producto.toLowerCase().includes(this.search_producto.toLowerCase());
                        });
                    }
                },

                seleccionarproducto(producto){
                    this.selectedProducto = producto.cod_producto;
                    this.nombre_producto = producto.nombre_producto ?? producto.nombre;
                    this.precio_producto = producto.precio_proveedor;
                    this.search_producto = '';
                    this.bloquear_producto = 'pointer-events: none';
                },

                clearInputProducto(){
                    this.selectedProducto = -1
                    this.nombre_producto = null;
                    this.precio_producto = null;
                    this.search_producto = '';
                    this.cant_pedido = null;
                    this.precio_pedido = null;
                    this.bloquear_producto = ''
                },

                calcular_precio(){
                    const cantidad = parseInt(this.cant_pedido);
                    const precioProducto = parseFloat(this.precio_producto);
                    this.precio_pedido = (cantidad * precioProducto).toFixed(2);
                },

                addProducto(){
                    const find = this.producto_pedido.find((producto_p) => producto_p.cod_producto == this.selectedProducto);

                    if(!find){
                        if(this.selectedProducto != -1 && this.cant_pedido != null){
                            this.producto_pedido.push({
                                cod_producto: this.selectedProducto,
                                nombre_producto: this.nombre_producto,
                                cantidad: this.cant_pedido,
                                monto: this.precio_pedido,
                                recibido: 'NO'
                            });
                        }else{
                            Swal.fire('Aviso', 'Debe escoger un producto y/o rellenar todos los campo', 'warning');
                        }
                    }else{
                        const index = this.producto_pedido.findIndex((producto_p) => producto_p.cod_producto == this.selectedProducto);
                        const cantidad = parseInt(find.cantidad) + parseInt(this.cant_pedido);
                        const precioProducto =parseFloat(find.monto) + parseFloat(this.precio_producto);
                        this.producto_pedido[index] = {
                            ...this.producto_pedido[index],
                            cantidad: cantidad,
                            monto: precioProducto.toFixed(2),
                        }
                    }


                    this.clearInputProducto();
                }
            }
        }
    </script>
@endpush
