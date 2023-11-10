<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts and SCSS -->
    @vite(['resources/sass/app.scss', 'resources/fontawesome/css/all.min.css', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/navbar.css', 'resources/css/bg-striped.css', 'resources/css/cart.css'])

    @yield('headextra')
</head>
@yield('modals')

<body>
    <div id="app">
        @yield('content')
        @component('components.footer')
        @endcomponent
    </div>
    @yield('scripts')
</body>

</html>
