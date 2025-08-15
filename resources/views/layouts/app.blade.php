<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="assets/css/dashlitee1e3.css?ver=3.2.4">
    <link id="skin-default" rel="stylesheet" href="assets/css/themee1e3.css?ver=3.2.4">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <script src="assets/js/bundlee1e3.js?ver=3.2.4"></script>
    <script src="assets/js/scriptse1e3.js?ver=3.2.4"></script>
    <script src="assets/js/demo-settingse1e3.js?ver=3.2.4"></script>
    <script src="assets/js/charts/gd-defaulte1e3.js?ver=3.2.4"></script>
</body>

</html>