<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    @vite(['resources/css/app.css', 'resources/js/public/app.js', 'resources/js/admin/app.js'])
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon"
        href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
     <title>Admin Panel | {{ setting('site_name', config('app.name')) }}</title>
         <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('head')

    @livewireStyles
</head>

<body class="bg-background text-foreground flex flex-col min-h-screen ">
    <!-- Header -->
    @include('admin.partials.nav')

    <div class="flex flex-col lg:flex-row flex-1 min-h-full">
        @include('admin.partials.aside')

        <!-- Main Content -->
        <main class="flex-1 pt-4 pb-4 p-4 min-w-0">
            <div class="mb-4 p-4 bg-card text-card-foreground border border-border shadow rounded-lg break-words">
                <h2 class="text-2xl font-semibold">@yield('admin.content.title')</h2>
            </div>

            <div
                class="mb-4 p-4 bg-card text-card-foreground border border-border shadow rounded-lg break-words min-w-0">
                @yield('admin.content')
            </div>
        </main>
    </div>

    <!-- Footer -->
    @include('admin.partials.footer')


    @include('admin.partials.notifications')
    @stack('scripts')
    @livewireScripts
</body>

</html>
