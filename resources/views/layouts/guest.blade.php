<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="ligth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PROMCE') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-sm  text-on-surface dark:text-on-surface-dark" >
        <div class="min-h-screen flex flex-col  items-center bg-surface dark:bg-surface-dark">
            <div class="mt-5 mb-10">
                <img style="width: 200px" src="https://www.fundacionalqueriacavelier.org/wp-content/uploads/2025/09/logo-fundacion-alqueria-v15-200-70-no-background.png" />
            </div>

                {{ $slot }}
        </div>
    </body>
</html>
