<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    @vite(['resources/css/public/app.css', 'resources/js/public/app.js'])
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <title>Admin Panel | {{ config('app.name') }}</title>
    @stack('head')
    @livewireStyles
</head>

<body class="bg-primary  ">

    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        @include('admin.partials.nav')

        <div class="flex flex-1">
            @include('admin.partials.aside')

            <!-- Main Content -->
            <main class="flex-1 pt-4 pb-4 pr-4">
                <div
                    class="mb-4 p-4 text-text-primary bg-surface border border-border shadow rounded-lg">
                    <h2 class="text-2xl font-semibold ">@yield('admin.content.title')</h2>
                </div>
                @yield('admin.content')
            </main>
        </div>

        <!-- Footer -->
        @include('admin.partials.footer')
    </div>


    @stack('scripts')
    @livewireScripts
</body>

</html>
