<x-app-layout>
    <div x-data="data()">
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mb-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <!-- Botón a la izquierda -->
                <div class="flex-shrink-0">
                    <a href="{{ route('configuracion.cliente.create') }}" class="focus:outline-none text-white bg-green-700
                        hover:bg-green-800 focus:ring-4 focus:ring-green-300
                        font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700
                        dark:focus:ring-green-800">
                        <i class="fa-solid fa-circle-plus"></i> Nuevo
                    </a>
                </div>

                <!-- Breadcrumb a la derecha -->
                <nav class="ml-auto">
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('dashboard') }}">Página Principal /</a>
                        </li>
                        <li class="font-medium text-primary">Clientes</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-2 lg:px-5">
            <div
                class="w-full p-4 bg-white border-t-4 border-indigo-800 rounded-lg shadow-lg sm:p-8 dark:bg-boxdark">
                <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
                    Clientes
                </h4>

                <div class="flex flex-col">
                    <div class="mb-4 ml-auto">
                        <x-input type="text" placeholder="Buscar" x-model="search" />
                    </div>
                    <div class="grid grid-cols-3 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-5">
                        <div class="p-2.5 xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">Cedula</h5>
                        </div>
                        <div class="p-2.5 text-center xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">Nombres</h5>
                        </div>
                        <div class="p-2.5 text-center xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">Apellidos</h5>
                        </div>
                        <div class="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">Telefono</h5>
                        </div>
                        <div class="hidden p-2.5 text-center sm:block xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">Acción</h5>
                        </div>
                    </div>

                    <template x-for="(cliente, key) in filteredClientes()" :key="key">
                        <div class="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-5">
                            <div class="flex items-center gap-3 p-2.5 xl:p-5">
                                <a :href="`{{ route('configuracion.cliente.show', '') }}/${cliente.nro_cliente}`"
                                    class="hidden font-medium text-primary sm:block" x-text="cliente.cedula_cliente">
                                </a>
                            </div>

                            <div class="flex items-center justify-center p-2.5 xl:p-5">
                                <p class="font-medium text-black dark:text-white" x-text="cliente.nombres"></p>
                            </div>

                            <div class="flex items-center justify-center p-2.5 xl:p-5">
                                <p class="font-medium text-black dark:text-white" x-text="cliente.apellidos"></p>
                            </div>

                            <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                <p class="font-medium text-black dark:text-white" x-text="cliente.nro_telefono">/p>
                            </div>

                            <div class="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
                                <div class="flex items-center space-x-3.5">
                                    <a :href="`{{ route('configuracion.cliente.edit', '') }}/${cliente.nro_cliente}`"
                                        class="hover:text-primary">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <button class="hover:text-primary" @click.prevent="deleteItem(cliente)">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div class="flex justify-between mt-4 mb-4 ml-auto">
                        <nav aria-label="Page navigation example">
                            <ul class="flex items-center -space-x-px h-10 text-base">
                                <li>
                                    <button
                                        class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        @click="prevPage" :disabled="currentPage === 1">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 1 1 5l4 4" />
                                        </svg>
                                    </button>
                                </li>
                                <template x-for="page in getTotalPages()" :key="page">
                                    <li>
                                        <a href="#"
                                            class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                            @click.prevent="goToPage(page)"
                                            :class="{ 'text-blue-600 border border-blue-300 bg-blue-50': currentPage === page }"
                                            x-text="page">
                                        </a>
                                    </li>
                                </template>
                                <li>
                                    <button
                                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        @click="nextPage" :disabled="currentPage === getTotalPages()">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>






        @push('js')
        <script>
            function data() {
                    return {
                        clientes: @json(@old('clentes', $clientes ?? [])),
                        search: '',
                        currentPage: 1,
                        itemsPerPage: 8,

                        init() {},

                        filteredClientes() {
                            const filtered = this.clientes.filter(cliente => {
                                return cliente.nombres.toLowerCase().includes(this.search.toLowerCase()) ||
                                    cliente.apellidos.toLowerCase().includes(this.search.toLowerCase()) ||
                                    cliente.cedula_cliente.toString().includes(this.search);
                            });

                            const start = (this.currentPage - 1) * this.itemsPerPage;
                            return filtered.slice(start, start + this.itemsPerPage);
                        },

                        getTotalPages() {
                            return Math.ceil(this.clientes.filter(cliente => {
                                return cliente.nombres.toLowerCase().includes(this.search.toLowerCase()) ||
                                    cliente.apellidos.toLowerCase().includes(this.search.toLowerCase()) ||
                                    cliente.cedula_cliente.toString().includes(this.search.toLowerCase());
                            }).length / this.itemsPerPage);
                        },

                        nextPage() {
                            if (this.currentPage < this.getTotalPages()) {
                                this.currentPage++;
                            }
                        },

                        prevPage() {
                            if (this.currentPage > 1) {
                                this.currentPage--;
                            }
                        },
                        goToPage(page) {
                            this.currentPage = page;
                        },

                        deleteItem(cliente) {
                            const route = `{{ route('configuracion.cliente.delete', '') }}/${cliente.nro_cliente}`;
                            Swal.fire({
                                icon: 'warning',
                                title:'¿Estas Seguro?',
                                html: 'El registro se borrara de forma permanente',
                                showCancelButton: true,
                                showConfirmButton: true,
                                confirmButtonText: "Si, Eliminar",
                                cancelButtonText: "Cancelar"
                            }).then(result => {
                                if(result.isConfirmed){
                                    try {
                                        window.location.href = route;
                                    } catch (error) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Ocurrió un error al eliminar el registro. Por favor, inténtalo de nuevo.'
                                        });
                                    }
                                }
                            })
                        }

                    };
                }
        </script>
        @endpush
</x-app-layout>
