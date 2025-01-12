<x-app-layout>
    <div x-data="data()">
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mb-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                <!-- Breadcrumb a la derecha -->
                <nav class="ml-auto">
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('dashboard') }}">Página Principal /</a>
                        </li>
                        <li class="font-medium text-primary">Datos Generales</li>
                    </ol>
                </nav>
            </div>
        </div>
        {{--  max-w-7xl   --}}
        <div class="mx-auto sm:px-2 lg:px-5">
            <div
                class="w-full p-4 bg-white border-t-4 border-indigo-800 rounded-lg shadow-lg sm:p-8 dark:bg-gray-800">
                <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
                    Productos
                </h4>

                <div class="flex flex-col">
                    <div class="mb-4 ml-auto">
                        <x-input type="text" placeholder="Buscar" x-model="search" />
                    </div>
                    <div class="grid grid-cols-3 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-2">
                        <div class="p-2.5 text-center xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">Descripción</h5>
                        </div>
                        <div class="p-2.5 text-center xl:p-5">
                            <h5 class="text-sm font-medium uppercase xsm:text-base">Valor</h5>
                        </div>

                    </div>

                    <template x-for="(dato, key) in filteredDatoGeneral()" :key="key">
                        <div class="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-2">
                            <div class="flex items-center justify-center  p-2.5 xl:p-5">
                                <p class="font-medium text-black dark:text-white" x-text="dato.descripcion"></p>
                            </div>

                            <div class="flex items-center justify-center p-2.5 xl:p-5">
                                <template x-if="!dato.input">
                                    <p class="font-medium text-black dark:text-white" x-text="dato.valor" @click.prevent="dato.input = true"></p>
                                </template>
                                <template x-if="dato.input">
                                    <x-input x-model="dato.valor" name="valor" @change="update(dato)" type="text" error="{{ $errors->has('valor') }}" @click.away="dato.input = false"/>
                                    <div class="invalid-feedback">
                                        @error('valor') {{ $message }} @enderror
                                    </div>
                                </template>

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
                                        <i class="fa-solid fa-angle-left"></i>
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
                                        <i class="fa-solid fa-angle-right"></i>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>






@push('js')
    <script>
        function data() {
            return {
                dato_general: @json(@old('dato_general', $dato_general ?? [])),
                search: '',
                currentPage: 1,
                itemsPerPage: 8,

                init() {
                    this.dato_general.map(dato => {
                        dato.input = false;
                    })
                },

                filteredDatoGeneral() {
                    const filtered = this.dato_general.filter(dato => {
                        return dato.descripcion.toLowerCase().includes(this.search.toLowerCase()) ||
                            dato.valor.toLowerCase().includes(this.search.toLowerCase())
                        });

                    const start = (this.currentPage - 1) * this.itemsPerPage;
                    return filtered.slice(start, start + this.itemsPerPage);
                },

                getTotalPages() {
                    return Math.ceil(this.dato_general.filter(dato => {
                        return dato.descripcion.toLowerCase().includes(this.search.toLowerCase()) ||
                            dato.valor.toLowerCase().includes(this.search.toLowerCase());
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

                update(dato){
                    console.log('El valor: '+dato.descripcion+' ha cambiado a: '+dato.valor)
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const url = `{{ route('configuracion.dato_general.update', '') }}/${dato.id}`;

                    const formData = new FormData();
                    formData.append('valor', dato.valor);

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            toast: true, // Habilita el modo toast
                            position: 'top-end', // Posición del toast
                            icon: data.icon, // Tipo de icono (success, error, warning, info, question)
                            title: data.msj, // Título del toast
                            showConfirmButton: false, // Oculta el botón de confirmación
                            timer: 3000, // Duración en milisegundos antes de que se cierre automáticamente
                            timerProgressBar: true, // Muestra la barra de progreso del temporizador
                        });

                    })
                },

            };
        }
    </script>
@endpush
</x-app-layout>
