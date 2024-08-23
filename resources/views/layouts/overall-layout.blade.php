<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EcoPlan HelpDesk</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <link rel="shortcut icon" href="{{ asset('images/logo1.png') }}" type="image/png">
        <!-- Styles -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

        <link rel="stylesheet" href="{{ asset('build/assets/app-D1-nV2Ph.css') }}">
        <script src="{{ asset('build/assets/app-SOzcb3O0.js') }}" defer></script>
    </head>
    <body class="antialiased font-sans">

        {{ $slot }}

    </body>
</html>
