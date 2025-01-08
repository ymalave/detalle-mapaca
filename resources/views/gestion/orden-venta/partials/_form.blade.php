<div x-data="data()">
    <div class="w-full p-4 bg-white border-t-4 border-indigo-800 rounded-lg shadow-lg sm:p-8 dark:bg-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Orden de Venta</h5>
        </div>
        <div class="flow-root">
            <div class="grid gap-4 mb-6 md:grid-cols-3">
                <div>
                    <x-label for="cedula_cliente" error="{{ $errors->has('cedula_cliente') }}">
                        Cedula Cliente
                    </x-label>

                    <x-input type="number" name="cedula_cliente" x-model="cedula_cliente" class="uppercase"
                        @blur="search_cliente()"
                        error="{{ $errors->has('cedula_cliente') }}" readonly="{{ $type != 'store' }}" />

                    @if ($errors->has('cedula_cliente'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cedula_cliente')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif

                </div>
                <div>
                    <x-label for="nombre_cliente" error="{{ $errors->has('nombre_cliente') }}">
                        Nombre
                    </x-label>


                    <x-input type="text" name="nombre_cliente" x-model="nombre_cliente" class="uppercase"
                        error="{{ $errors->has('nombre_cliente') }}" readonly />
                    <x-input type="hidden" name="nro_cliente" x-model="nro_cliente" class="uppercase"
                        error="{{ $errors->has('nro_cliente') }}" readonly />

                    @if ($errors->has('nombre_cliente'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('nombre_cliente')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="usuario" error="{{ $errors->has('usuario') }}">
                        Vendedor
                    </x-label>
                    <x-input type="text" name="nombre_usuario" x-model="nombre_usuario" class="uppercase"
                        error="{{ $errors->has('nombre_usuario') }}" readonly />

                    @if ($errors->has('nombre_usuario'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('nombre_usuario')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="fecha_solicitud" error="{{ $errors->has('fecha_solicitud') }}">Fecha
                        Solicitud</x-label>

                    <x-input type="date" name="fecha_solicitud" x-model="fecha_solicitud"
                        error="{{ $errors->has('fecha_solicitud') }}" readonly/>

                    @if ($errors->has('fecha_solicitud'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('fecha_solicitud')
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
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div>
                                        <div class="w-full" x-show="selectedProducto >= 0">
                                            <div class="flex">
                                                <x-input name="nombre_producto" x-bind:style="bloquear_producto"
                                                    class="rounded-none rounded-s-lg"
                                                    x-bind:class="type == 'show' ? 'rounded-e-lg' : ''"
                                                    error="{{ $errors->has('nombre_producto') }}"
                                                    x-model="nombre_producto" />
                                                <x-input name="cod_producto" type="hidden"
                                                    x-model="selectedProducto" />
                                                @if ($type != 'show')
                                                    <span
                                                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 border-gray-300 border-s-0 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600"
                                                        @click="clearInputProducto()">
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                @endif

                                                <template x-if="errors['nombre_producto']">
                                                    <div class="text-red-500 text-sm"
                                                        x-text="errors['nombre_producto']"></div>
                                                </template>
                                            </div>
                                        </div>
                                        <div class="w-full" x-show="selectedProducto < 0">
                                            <x-input type="text" error="{{ $errors->has('nombre_producto') }}"
                                                x-model="search_producto" placeholder="Buscar producto" @input="filterProducto()" />
                                            <template x-if="errors['nombre_producto']">
                                                <div class="text-red-500 text-sm" x-text="errors['nombre_producto']">
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <div class="flex-grow overflow-y-20 absolute">
                                        <template x-if="search_producto.length > 0 && search_producto.length < 3 && isNaN(search_producto)">
                                            <a class="list-group-item list-group-item-action">
                                                <span>Ingrese 3 letras o más</span>
                                            </a>
                                        </template>

                                        <template x-if="search_producto.length > 2 && productos.length == 0">
                                            <a class="w-full col-12">
                                                No se encontraron resultados
                                            </a>
                                        </template>

                                        <template x-if="productos.length > 0 && search_producto != ''">
                                            <template x-for="producto in productos" :key="producto.cod_producto">
                                                <a class="cursor-pointer block min-w-50 p-2 text-left bg-white hover:bg-gray-200"
                                                    @click="seleccionarproducto(producto)">
                                                    <span x-text="producto.nombre_producto"
                                                        class="relative text-gray-800"></span>
                                                </a>
                                            </template>
                                        </template>

                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    <x-input name="cant_pedido" type="nomber" @blur="calcular_precio()"
                                        error="{{ $errors->has('cant_pedido') }}" x-model="cant_pedido"
                                        placeholder="Cantidad pedido" />
                                </td>
                                <td class="px-6 py-4">
                                    <x-input name="precio_pedido" type="number" step="0.01"
                                        error="{{ $errors->has('precio_pedido') }}" x-model="precio_pedido"
                                        placeholder="Precio" readonly />
                                </td>
                                <td>
                                    <x-button class="text-xs font-medium text-center" style="indigo"
                                        @click.prevent="addProducto()"><i class="fa-solid fa-plus"></i></x-button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            @endif

            <div class="overflow-x-auto shadow-md sm:rounded-lg mb-6">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-50 uppercase bg-indigo-800 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Cod. Producto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Producto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <template x-if="venta_detalle.length > 0">
                            <template x-for="(item, key) in venta_detalle" key="key">
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <span x-text="item.cod_producto"></span>
                                        <x-input type="hidden" x-bind:name="`venta_detalle[${key}][cod_producto]`"
                                            x-model="item.cod_producto" />
                                    </th>
                                    <td class="px-6 py-4">
                                        <span x-text="item.nombre_producto"></span>
                                        <x-input type="hidden"
                                        x-bind:name="`venta_detalle[${key}][nombre_producto]`"
                                        x-model="item.nombre_producto" />
                                    </td>
                                    <td class="px-6 py-4">
                                        <span x-text="item.cantidad"></span>
                                        <x-input type="hidden" x-bind:name="`venta_detalle[${key}][cantidad]`"
                                            x-model="item.cantidad" />
                                    </td>
                                    <td class="px-6 py-4">
                                        <span x-text="item.monto"></span>
                                        <x-input type="hidden" x-bind:name="`venta_detalle[${key}][monto]`"
                                            x-model="item.monto" />
                                    </td>

                                    <td width="50px" class="px-6 py-4">
                                        <x-button class="text-xs font-medium text-center" style="indigo"
                                            @click.prevent="editProducto(item, key)">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </x-button>
                                    </td>

                                </tr>
                            </template>
                        </template>

                        <template x-if="venta_detalle.length <= 0">
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="text-center px-6 py-4 text-gray-900" colspan="4">
                                    <span>No se encontraron registros</span>
                                </td>

                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <div class="grid gap-4 mb-6 md:grid-cols-3">
                <div>
                    <x-label for="monto_total" error="{{ $errors->has('monto_total') }}">
                        Monto Total
                    </x-label>

                    <x-input type="number" name="monto_total" x-model="monto_total" class="uppercase" step="0.01"
                        error="{{ $errors->has('monto_total') }}" readonly="{{ $type != 'store' }}" />

                    @if ($errors->has('monto_total'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('monto_total')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif

                </div>

                <div>
                    <x-label for="estado" error="{{ $errors->has('estado') }}">
                        Estado
                    </x-label>

                    <x-select id="estado" name="estado" x-model="estado"
                        style="{{ $type == 'show' ? 'pointer-events: none' : '' }}"
                        error="{{ $errors->has('estado') }}">
                        <option value="" selected hidden>-- Seleccione --</option>
                        <option value="PENDIENTE">PENDIENTE</option>
                        <option value="EN PROCESO">EN PROCESO</option>
                        <option value="FACTURADA">FACTURADA</option>
                    </x-select>

                    @if ($errors->has('estado'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('estado')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif

                </div>
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
                errors: JSON.parse('{{ $errors->toJson() }}'.replace(/&quot;/g, '"')),
                cedula_cliente: '{{ old("cedula_cliente", $cliente->cedula_cliente ?? '') }}',
                nombre_cliente: '{{ old("nombre_cliente", $cliente->nombre_cliente ?? '') }}',
                nombre_usuario: '{{ old("nombre_usuario", $user->name ?? '') }}',
                fecha_solicitud: '{{ old("fecha_solicitud", $venta->created_at->format("Y-m-d") ?? now()->format("Y-m-d")) }}',
                monto_total: '{{ old("monto_total", $venta->monto_total ?? 0) }}',
                nro_cliente: '{{ old("nro_cliente", $venta->nro_cliente ?? '') }}',
                estado: '{{ old("estado", $venta->estado ?? '') }}',

                productos: @json(@old('productos', $productos ?? [])),
                venta_detalle: @json(@old('venta_detalle', $venta_detalle ?? [])),

                selectedProducto: -1,
                search_producto: '',
                bloquear_producto: '',
                nombre_producto: '',
                precio_producto: null,
                cant_pedido: null,
                precio_pedido: null,


                init() {

                },

                filterProducto() {
                    this.productos = [];
                    if(this.search_producto.length > 3 || !isNaN(this.search_producto)){
                        const route = `{{ env('APP_URL') }}/api/gestion/orden-venta/get-producto/${this.search_producto}`;

                        fetch(route)
                        .then(response => response.json())
                        .then(data => {
                            this.productos = data;
                        })
                    }

                },

                seleccionarproducto(producto) {
                    this.selectedProducto = producto.cod_producto;
                    this.nombre_producto = producto.nombre_producto ?? producto.nombre;
                    this.precio_producto = producto.precio_venta;
                    this.search_producto = '';
                    this.bloquear_producto = 'pointer-events: none';
                },

                clearInputProducto() {
                    this.selectedProducto = -1
                    this.nombre_producto = null;
                    this.precio_producto = null;
                    this.search_producto = '';
                    this.cant_pedido = null;
                    this.precio_pedido = null;
                    this.bloquear_producto = ''
                },

                calcular_precio() {
                    const cantidad = parseInt(this.cant_pedido);
                    const precioProducto = parseFloat(this.precio_producto);
                    this.precio_pedido = (cantidad * precioProducto).toFixed(2);
                },

                addProducto() {
                    const find = this.venta_detalle.find((producto_p) => producto_p.cod_producto == this
                    .selectedProducto);

                    if (!find) {
                        if (this.selectedProducto != -1 && this.cant_pedido != null) {
                            this.venta_detalle.push({
                                cod_producto: this.selectedProducto,
                                nombre_producto: this.nombre_producto,
                                cantidad: this.cant_pedido,
                                monto: this.precio_pedido,
                                recibido: 'NO'
                            });
                        } else {
                            Swal.fire('Aviso', 'Debe escoger un producto y/o rellenar todos los campo', 'warning');
                        }
                    } else {
                        const index = this.venta_detalle.findIndex((producto_p) => producto_p.cod_producto == this
                            .selectedProducto);
                        const cantidad = parseInt(find.cantidad) + parseInt(this.cant_pedido);
                        const precioProducto = parseFloat(find.monto) + parseFloat(this.precio_pedido);
                        this.venta_detalle[index] = {
                            ...this.venta_detalle[index],
                            cantidad: cantidad,
                            monto: precioProducto.toFixed(2),
                        }
                    }


                    this.clearInputProducto();
                    this.calcula_monto_total();
                },

                search_cliente(){
                    this.nombre_cliente = '';
                    const route = `{{ env('APP_URL') }}/api/gestion/orden-venta/get-cliente/${this.cedula_cliente}`;

                    fetch(route)
                    .then(response => response.json())
                    .then(data => {
                        if(data.cedula_cliente){
                            this.cedula_cliente = data.cedula_cliente;
                            this.nombre_cliente = data.nombre_cliente;
                            this.nro_cliente = data.nro_cliente;
                        }else{
                            Swal.fire({
                                title: 'Cliente no encontrado',
                                icon: 'info',
                                showCancelButton: true,
                                confirmButtonText: 'Registrar',
                                cancelButtonText: 'Cancelar'
                            }).then((result) => {
                                if(result.isConfirmed){
                                    window.open('{{ route("configuracion.cliente.create") }}', 'Ventana Emergente', 'width=1080,height=720');
                                }
                            })
                        }
                    })
                },

                calcula_monto_total(){
                    let suma = 0;
                    this.venta_detalle.forEach(det_venta => {
                        suma += parseFloat(det_venta.monto);
                    })

                    this.monto_total = suma;
                },

                editProducto(info, key){
                    this.venta_detalle.splice(key, 1);
                    this.calcula_monto_total();

                    const route = `{{ env('APP_URL') }}/api/gestion/orden-venta/get-producto-esp/${info.cod_producto}`;

                    fetch(route)
                    .then(response => response.json())
                    .then(data => {
                        this.seleccionarproducto(data);
                        this.cant_pedido = info.cantidad;
                        this.precio_pedido = info.monto;
                    })
                }
            }
        }
    </script>
@endpush
