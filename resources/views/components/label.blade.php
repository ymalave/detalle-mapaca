@props(['value', 'error' => false])

<label {{ $attributes->merge(['class' => $error == true ? 'block mb-2 text-sm font-medium text-red-700 dark:text-red-500' :
                                'block mb-2 text-sm font-medium  text-gray-900 dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
