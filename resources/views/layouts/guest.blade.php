<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

         <title>{{ __('messages.apptitle') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased wallpaper">
        <div class="wallpaper-login min-h-screen flex flex-col sm:justify-center items-center pt-4 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            {{-- <div>
                <a href="/">
                    <x-application-logo class="w-50 h-40 fill-current text-gray-500" />
                </a>
            </div> --}}

            <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg outline outline-sky-500">
                <div class="flex items-center justify-center">
                    <a href="/">
                        <x-application-logo class="w-50 h-40 fill-current text-gray-500" />
                    </a>
                    
                    @if (request()->routeIs('admin.login') || request()->routeIs('admin.register'))
                        <p class="subpixel-antialiased font-bold font-stretch-condensed text-2xl">{{ __('messages.associate') }}</p>
                    @endif
                </div>
                
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
