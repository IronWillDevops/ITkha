<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="IT blog with articles, tutorials, and more.">
    <meta name="keywords" content="IT, tutorials, blog, technology">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/public/app.css', 'resources/js/public/app.js'])
    <title>{{ config('app.name') }} - @yield('title')</title>
    @stack('head')
</head>

<body class="bg-background flex flex-col min-h-screen">
    @include('public.partials.navbar')
    <main class="flex-grow container mx-auto px-4 py-6">
        <div class="h-full lg:flex-row gap-6">
            <div class="mt-8 grid bg-card text-card-foreground border border-border rounded-lg gap-6">
                <div class="flex flex-col items-center justify-center py-20 px-6 rounded-md">
                    {{-- Если передали секцию icon — выводим её, иначе дефолт --}}
                    <div class="fa-4x mb-4">
                        @hasSection('icon')
                            @yield('icon')
                        @else
                            <i class="fa-solid fa-circle-exclamation"></i>
                        @endif
                    </div>
                    <h2 class="text-2xl font-semibold ">@yield('code') - @yield('title')</h2>
                    <span class="text-secondary-foreground mt-2">@yield('message')</span>

                    <a href="{{ route('public.post.index') }}" class="inline-block mt-2 px-6 py-2 rounded transition hover:underline">
                        <i class="fas fa-home"></i><span class='ml-2'>Return to home page</span>
                    </a>
                </div>
            </div>
        </div>
    </main>
    @include('public.partials.footer')
    @stack('scripts')
</body>


</html>
