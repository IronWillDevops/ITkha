<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    @vite(['resources/css/public/app.css', 'resources/js/public/app.js'])
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon"
        href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ setting('site_description', 'Default description') }}">
    <meta name="keywords" content="{{ setting('site_keywords', 'blog,laravel') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <x-public.seo-meta :type="$seo['type']" :title="$seo['title']" :description="$seo['description']" :image="$seo['image']" :url="$seo['url']" 
    :extra="$seo['extra']"/>
    <title>{{ setting('site_name', config('app.name')) }}</title>
    @stack('head')
    @livewireStyles
</head>

<body class="bg-background text-foreground flex flex-col min-h-screen">
    @if (Auth::check() && Auth::user()->hasPermission('setting.access'))
        @include('public.partials.admin-link')
    @endif


    @include('public.partials.navbar')

    <main class="flex-grow container mx-auto px-4 py-6">
        @yield('public.layouts')
    </main>



    @include('public.partials.footer')

    @include('public.partials.notifications')
    @include('public.partials.cookie')

    @stack('scripts')
    @livewireScripts
    
</body>

</html>
