<div x-data="data()">
    <div
        class="w-full p-4 bg-white border-t-4 border-indigo-800 rounded-lg shadow-lg sm:p-8 dark:bg-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Proveedor</h5>
        </div>
        <div class="flow-root">

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-label for="proveedor[rif]" error="{{ $errors->has('proveedor.rif') }}">
                        Cedula ó Rif
                    </x-label>
                    <x-input type="text" name="proveedor[rif]" x-model="proveedor.rif" class="uppercase"
                        readonly="{{ $type !== 'store' }}" error="{{ $errors->has('proveedor.rif') }}"
                        data-tooltip-target="tooltip-rif" data-tooltip-placement="bottom"/>

                    <div id="tooltip-rif" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        Debe iniciar con ( V, E, J ó G) y el resto ser numerico
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @if ($errors->has('proveedor.rif'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('proveedor.rif')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="proveedor[nombre]" error="{{ $errors->has('proveedor.nombre') }}">Nombre</x-label>

                    <x-input type="text" name="proveedor[nombre]" x-model="proveedor.nombre"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('proveedor.nombre') }}" />

                    @if ($errors->has('proveedor.nombre'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('proveedor.nombre')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="proveedor[direccion]"
                        error="{{ $errors->has('proveedor.direccion') }}">Dirección</x-label>

                    <x-input type="text" name="proveedor[direccion]" x-model="proveedor.direccion"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('proveedor.direccion') }}" />

                    @if ($errors->has('proveedor.direccion'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('proveedor.direccion')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="proveedor[telefono]" error="{{ $errors->has('proveedor.telefono') }}">Nro.
                        Telefónico</x-label>

                    <x-input type="text" name="proveedor[telefono]" x-model="proveedor.telefono"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('proveedor.telefono') }}" />

                    @if ($errors->has('proveedor.telefono'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('proveedor.telefono')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="proveedor[email]" error="{{ $errors->has('proveedor.email') }}">Correo Electrónico</x-label>
                    <x-input type="email" name="proveedor[email]" x-model="proveedor.email"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('proveedor.nombre') }}" />
                    @if ($errors->has('proveedor.email'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('proveedor.email')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>

                <div></div>

                <div>
                    <x-label for="proveedor[cedula_representante]"
                        error="{{ $errors->has('proveedor.cedula_representante') }}">Cedula Representante</x-label>

                    <x-input type="text" name="proveedor[cedula_representante]" x-model="proveedor.cedula_representante"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('proveedor.cedula_representante') }}" />

                    @if ($errors->has('proveedor.cedula_representante'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('proveedor.cedula_representante')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="proveedor[nombre_representante]"
                        error="{{ $errors->has('proveedor.nombre_representante') }}">Nombre Representante</x-label>

                    <x-input type="text" name="proveedor[nombre_representante]" x-model="proveedor.nombre_representante"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('proveedor.nombre_representante') }}" />

                    @if ($errors->has('proveedor.nombre_representante'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('proveedor.nombre_representante')
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
                proveedor: @json(@old('proveedor', $proveedor?->toArray() ?? []))
            }
        }
    </script>
@endpush
