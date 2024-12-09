<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Madera y papeleria') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js',
        'resources/js/all.min.js', 'resources/js/fontawesome.min.js',
        'resources/css/all.min.css', 'resources/css/fontawesome.min.css'])


</head>

<body class="font-sans antialiased">
    <div class="flex h-screen overflow-hidden" x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
        :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">
        @include('loader')
        <!--  Sidebar Start  -->
        <x-menu />
        <!--  Sidebar End  -->

        <!--  Content Area Start  -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!--  Header Start  -->
            <x-header />
            {{ $slot }}
        </div>
    </div>
    </div>

    @livewireScripts

    <!-- Sweetalert -->
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @include('sweetalert::alert')

    @stack('js')
</body>

</html>
