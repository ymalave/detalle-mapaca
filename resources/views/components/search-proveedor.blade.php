<div>
    <div>
        <x-label for="proveedor" error="{{ $errors->has('nombre_proveedor') }}">Proveedor</x-label>
        <div class="w-full" x-show="selectedValue >= 0">
            <div class="mb-3 flex">
                <x-input  name="nombre_proveedor" x-bind:style="bloquear_proveedor"
                    class="rounded-none rounded-s-lg"
                    x-bind:class="type == 'show' ? 'rounded-e-lg' : ''"
                    error="{{ $errors->has('nombre_proveedor') }}"
                    x-model="nombre_proveedor" />
                <x-input name="cod_proveedor" type="hidden" x-model="selectedValue" />
                @if ($type != 'show')
                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-s-0 border-gray-300 border-s-0 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600"
                        @click="clearInput()">
                        <i class="fas fa-times"></i>
                    </span>
                @endif

                <template x-if="errors['nombre_proveedor']">
                    <div class="text-red-500 text-sm" x-text="errors['nombre_proveedor']"></div>
                </template>
            </div>
        </div>
        <div class="w-full" x-show="selectedValue < 0">
            <x-input type="text"  error="{{ $errors->has('nombre_proveedor') }}"
                x-model="search" placeholder="Buscar empresa" />
            <template x-if="errors['nombre_proveedor']">
                <div class="text-red-500 text-sm" x-text="errors['nombre_proveedor']"></div>
            </template>
        </div>
    </div>

    <div class="flex-grow overflow-y-auto block">
        <template x-if="search.length > 0 && search.length < 3">
            <a class="list-group-item list-group-item-action">
                <span>Ingrese 3 letras o más</span>
            </a>
        </template>

        <template x-if="search.length > 2 && proveedores.length == 0">
            <a class="w-full col-12">
                No se encontraron resultados
            </a>
        </template>

        <template x-if="proveedores.length > 0">
            <template x-for="proveedor in filterProveedor()" :key="proveedor.cod_proveedor">
                <a class="cursor-pointer block min-w-50 p-2 text-left bg-white hover:bg-gray-200"
                    @click="seleccionarProveedor(proveedor)">
                    <span x-text="proveedor.nombre_proveedor" class="text-gray-800"></span>
                </a>
            </template>
        </template>

    </div>
</div>

@push('js')
    <script>
        function dataProveedor() {
            return {
                errors: JSON.parse('{{ $errors->toJson() }}'.replace(/&quot;/g, '"')),
                selectedValue: -1,
                search: '',
                bloquear_proveedor: '',


                filterProveedor() {
                    if (this.search.length > 2) {
                        return this.proveedores.filter(proveedor => {
                            return proveedor.cod_proveedor.toString().toLowerCase().includes(this.search.toLowerCase()) ||
                                proveedor.nombre_proveedor.toLowerCase().includes(this.search.toLowerCase());
                        });
                    }
                },

                seleccionarProveedor(proveedor){
                    this.selectedValue = parseInt(proveedor.cod_proveedor)
                    this.cod_proveedor = proveedor.cod_proveedor
                    this.nombre_proveedor = proveedor.nombre_proveedor ?? proveedor.nombre
                    this.search = '',
                    this.bloquear_proveedor = 'pointer-events: none'
                },

                clearInput(){
                    this.selectedValue = -1
                    this.cod_proveedor = null
                    this.nombre_proveedor = null
                    this.search = '',
                    this.bloquear_proveedor = ''
                }

            }
        }
    </script>
@endpush
