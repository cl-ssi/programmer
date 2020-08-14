<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <script defer src="{{ asset('js/font-awesome/all.min.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('custom_css')
    @yield('custom_js_head')
</head>
<body>

    <div id="app">
        <header class="mb-3">
            @include('layouts/partials/nav')
        </header>

        <main role="main" class="container">
            <div class="d-none d-print-block">
                <strong>{{ config('app.ss') }}</strong><br>
                Ministerio de Salud
            </div>
            @include('layouts/partials/errors')
            @include('layouts/partials/flash_message')
            @yield('content')
        </main>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    @yield('custom_js')
</body>
</html>
