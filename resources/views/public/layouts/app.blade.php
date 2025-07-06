<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    @vite(['resources/css/public/app.css', 'resources/js/public/app.js'])
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="IT blog with articles, tutorials, and more.">
    <meta name="keywords" content="IT, tutorials, blog, technology">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">




    <title>{{ config('app.name') }}</title>
    @stack('head')
</head>

<body class="bg-primary flex flex-col min-h-screen">
    @if (Auth::check() && Auth::user()->hasPermission('admin_access'))
        @include('public.partials.admin-link')
    @endif


    @include('public.partials.navbar')

    <main class="flex-grow container mx-auto px-4 py-6">
        <div class="flex flex-col lg:flex-row gap-6  ">
            @php

                $route = ['public.post.index', 'public.post.show'];
            @endphp


            @if (in_array(Route::currentRouteName(), $route))
                <div class="w-full lg:w-4/5">
                    @yield('public.content')
                </div>
                <aside class="w-full lg:w-1/5 ">
                    @include('public.partials.sidebar')
                </aside>
            @else
                <div class="w-full">
                    @yield('public.content')
                </div>
            @endif

        </div>
    </main>



    @include('public.partials.footer')

    @include('public.partials.notifications')

    @stack('scripts')
</body>

</html>
