<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- @stack('styles') --}}
    @livewireStyles
</head>

<body>

    <div id="app">
        @include('components.navbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    {{-- @stack('scripts') --}}
    @livewireScripts
    {{-- untuk event --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  

    {{-- digunakan untuk delete --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- render otomatis --}}
    <script>
        Livewire.on('userStore', () => {
            $('#userModal').modal('hide');
            $('#editModal').modal('hide');
        })
    </script>

</body>

</html>
