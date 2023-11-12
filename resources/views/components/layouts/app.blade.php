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

            document.addEventListener('alpine:init', () => {
                Alpine.data('container', () => ({
                    show: false
                }))
            })
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/datepicker.min.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>{{ env('APP_NAME') . ' :: ' . __('web.' . Route::currentRouteName())  }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Gabarito&display=swap');

            [x-cloak] {
                display: none !important;
            }

            .rounded-div-profile {
                 background-image: url({{ url('/api/image/profile-picture') }});
                 background-position:50%;
                 background-repeat:no-repeat;
                 background-size: cover;
            }
        </style>
    </head>
    <body style="font-family: 'Gabarito', sans-serif;" class="dark:bg-gray-900 bg-gray-50 dark:text-white" x-data="container">
        @if( !auth()->check() )
            <main x-show="show" x-transition:enter.duration.300ms x-init="$nextTick(() => show = true)" x-cloak>
                <div class="h-screen w-full flex justify-center items-center" >
                    {{ $slot }}
                </div>
            </main>
        @else
            @livewire('sidebar')
            <!--
            <div class="sm:ml-64">
                @livewire('topbar')
            </div>
            -->
            <div class="relative p-2 sm:ml-64">
                <main x-show="show" x-transition:enter.duration.300ms x-init="$nextTick(() => show = true)" x-cloak>
                    {{ $slot }}
                    @if(session()->has('alert_message'))
                        @include('.components.alert')
                    @endif

                    @livewire('wire-elements-modal')
                </main>
            </div>

        @endif
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    </body>
</html>