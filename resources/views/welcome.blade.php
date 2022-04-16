<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Firebase - Pratical Appringer</title>
        <link rel="icon" href="{{asset('admin/images/favicon.png')}}" sizes="32x32" />
        <link rel="icon" href="{{asset('admin/images/favicon.png')}}" sizes="192x192" />
        <link rel="apple-touch-icon" href="{{asset('admin/images/favicon.png')}}" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('font/css/developer.css')}}">
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0" style="background-image: url('./public/font/assets/bg-masthead.jpg');
        background-size: cover; height:480px; padding-top:80px;">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif --}}
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8" >
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <img src="{{asset('/font/assets/welcome2.png')}}" alt="">

                </div>
            </div>
        </div>
    </body>
</html>
