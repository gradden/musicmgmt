<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>{{ $title ?? 'MusicMGMT App' }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Gabarito&display=swap');
        </style>
    </head>
    <body style="font-family: 'Gabarito', sans-serif;" class="dark:bg-gray-900 bg-gray-50 dark:text-white">
        @if( !auth()->check() )
            <div class="h-screen w-full flex justify-center items-center ">
                {{ $slot }}
            </div>
        @else
            @livewire('sidebar')
            <!--
            <div class="sm:ml-64">
                @livewire('topbar')
            </div>
            -->
            <div class="p-2 sm:ml-64 overflow-y-scroll">
                <main>
                    {{ $slot }}
                    @livewire('wire-elements-modal')
                </main>
            </div>

        @endif
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    </body>
</html>