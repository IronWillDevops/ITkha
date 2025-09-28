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
    @livewireStyles
</head>

<body class="bg-background text-foreground flex flex-col min-h-screen">
    @if (Auth::check() && Auth::user()->hasPermission('admin_access'))
        @include('public.partials.admin-link')
    @endif


    @include('public.partials.navbar')

    <main class="flex-grow container mx-auto px-4 py-6">
        @yield('public.layouts')
    </main>



    @include('public.partials.footer')

    @include('public.partials.notifications')

    @stack('scripts')
    @livewireScripts
</body>

</html>
