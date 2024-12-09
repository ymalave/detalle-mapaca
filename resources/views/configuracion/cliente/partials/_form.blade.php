<div x-data="data()">
    <div
        class="w-full p-4 bg-white border-t-4 border-indigo-800 rounded-lg shadow-lg sm:p-8 dark:bg-gray-800">
        <div class="flex items-center justify-between mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Cliente</h5>
        </div>
        <div class="flow-root">

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-label for="cliente[cedula_cliente]" error="{{ $errors->has('cliente.cedula_cliente') }}">
                        Nro. de Cedula
                    </x-label>
                    <x-input type="text" name="cliente[cedula_cliente]" x-model="cliente.cedula_cliente"
                        readonly="{{ $type !== 'store' }}" error="{{ $errors->has('cliente.cedula_cliente') }}" />
                    @if ($errors->has('cliente.cedula_cliente'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cliente.cedula_cliente')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="cliente[nombres]" error="{{ $errors->has('cliente.nombres') }}">Nombres</x-label>

                    <x-input type="text" name="cliente[nombres]" x-model="cliente.nombres"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('cliente.nombres') }}" />

                    @if ($errors->has('cliente.nombres'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cliente.nombres')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="cliente[apellidos]"
                        error="{{ $errors->has('cliente.apellidos') }}">Apellidos</x-label>

                    <x-input type="text" name="cliente[apellidos]" x-model="cliente.apellidos"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('cliente.apellidos') }}" />

                    @if ($errors->has('cliente.apellidos'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cliente.apellidos')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="cliente[direccion]"
                        error="{{ $errors->has('cliente.direccion') }}">Dirección</x-label>

                    <x-input type="text" name="cliente[direccion]" x-model="cliente.direccion"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('cliente.direccion') }}" />

                    @if ($errors->has('cliente.direccion'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cliente.direccion')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="cliente[nro_telefono]" error="{{ $errors->has('cliente.nro_telefono') }}">Nro.
                        Telefónico</x-label>

                    <x-input type="text" name="cliente[nro_telefono]" x-model="cliente.nro_telefono"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('cliente.nombre') }}" />

                    @if ($errors->has('cliente.nro_telefono'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cliente.nro_telefono')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <x-label for="cliente[email]" error="{{ $errors->has('cliente.email') }}">Correo Electrónico</x-label>
                    <x-input type="email" name="cliente[email]" x-model="cliente.email"
                        readonly="{{ $type == 'show' }}" error="{{ $errors->has('cliente.nombre') }}" />
                    @if ($errors->has('cliente.email'))
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('cliente.email')
                                {{ $message }}
                            @enderror
                        </p>
                    @endif
                </div>
                <div>
                    <label for="cliente[sexo]"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexo</label>
                    <x-select id="sexo" name="cliente[sexo]" x-model="cliente.sexo"
                        style="{{ $type == 'show' ? 'pointer-events: none' : '' }}">
                        <option value="" selected hidden>-- Seleccione --</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </x-select>
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
                cliente: @json(@old('cliente', $cliente?->toArray() ?? []))
            }
        }
    </script>
@endpush
