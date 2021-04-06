<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>@yield('title')</title>
        @env('local')
            <script src="http://localhost:8000/livereload.js"></script>
        @endenv
        <script src="{{ asset('js/manifest.js') }}"></script>
        <script src="{{ asset('js/vendor.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        @stack('styles')
        @livewireStyles
    </head>
    <body class="bg-[#FCFCFC] h-full">
        @include('layouts.header')
        <main class="mt-16">
            @yield('content')
        </main>

    </body>
    @stack('modals')
    @stack('scripts')
    @livewireScripts
</html>
