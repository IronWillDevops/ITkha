@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

        {{-- LEFT SIDEBAR --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24 space-y-6">

                <div class="bg-card rounded-xl border border-border shadow-lg p-6 text-center">
                    {{-- Avatar --}}
                    <div class="mb-4 flex justify-center">
                        @if ($user->singleMedia('avatar'))
                            <img class="w-32 h-32 object-cover rounded-full border-4 border-primary"
                                src="{{ $user->singleMedia('avatar')->url }}" alt="{{ $user->first_name }}">
                        @else
                            <div
                                class="w-32 h-32 flex items-center justify-center rounded-full border-4 border-primary text-4xl font-bold">
                                {{ $user->getInitial() }}
                            </div>
                        @endif
                    </div>

                    {{-- Name --}}
                    <h1 class="text-xl font-bold text-primary">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </h1>

                    <p class="text-muted-foreground text-sm">
                        {{ $user->profile?->job_title }}
                    </p>

                    @if ($user->profile?->address)
                        <p class="text-xs text-muted-foreground mt-1">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            {{ $user->profile?->address }}
                        </p>
                    @endif

                </div>

                {{-- ACTIONS --}}
                @if (Auth::check() && Auth::user()->id == $user->id)
                    <div class="bg-card rounded-xl border border-border shadow-lg p-4 space-y-3">

                        <!-- User action cards (1 col on mobile, 2 cols on md+) -->
                        <div class=" grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4 ">
                            <a href="#" rel="noopener noreferrer"
                                class="bg-background border border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring  rounded-md flex items-center focus:ring focus:outline-none gap-4 p-4">
                                <i class="fas fa-pen text-xl"></i>
                                <div>
                                    <p class="text-sm font-semibold">{{ __('public/user.buttons.my_post.title') }}</p>
                                    <p class="text-xs text-muted-foreground font-normal">
                                        {{ __('public/user.buttons.my_post.description') }}</p>
                                </div>
                            </a>

                            <a href="#" rel="noopener noreferrer"
                                class="bg-background border border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring  rounded-md flex items-center focus:ring focus:outline-none gap-4 p-4">
                                <i class="fas fa-heart text-xl"></i>
                                <div>
                                    <p class="text-sm font-semibold">{{ __('public/user.buttons.liked_post.title') }}
                                    </p>
                                    <p class="text-xs text-muted-foreground font-normal">
                                        {{ __('public/user.buttons.liked_post.description') }}</p>
                                </div>
                            </a>
                            <a href="#" rel="noopener noreferrer"
                                class="bg-background border border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring  rounded-md flex items-center focus:ring focus:outline-none gap-4 p-4">
                                <i class="fas fa-bookmark text-xl"></i>
                                <div>
                                    <p class="text-sm font-semibold">
                                        {{ __('public/user.buttons.favorite_post.title') }}
                                    </p>
                                    <p class="text-xs text-muted-foreground font-normal">
                                        {{ __('public/user.buttons.favorite_post.description') }}
                                    </p>
                                </div>
                            </a>

                            <a href="#" rel="noopener noreferrer"
                                class="bg-background border border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring  rounded-md flex items-center focus:ring focus:outline-none gap-4 p-4">
                                <i class="fas fa-cog text-xl"></i>
                                <div>
                                    <p class="text-sm font-semibold">{{ __('public/user.buttons.edit_profile.title') }}
                                    </p>
                                    <p class="text-xs text-muted-foreground font-normal">
                                        {{ __('public/user.buttons.edit_profile.description') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        {{-- RIGHT CONTENT --}}
        <div class="lg:col-span-3 space-y-8">

            {{-- STATISTICS --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-card border border-border rounded-xl p-6 text-center shadow-sm">
                    <p class="text-2xl font-bold">{{ $user->posts()->count() }}</p>
                    <p class="text-sm text-muted-foreground">Posts</p>
                </div>

                <div class="bg-card border border-border rounded-xl p-6 text-center shadow-sm">
                    <p class="text-2xl font-bold">{{ $user->likedPosts()->count() ?? 0 }}</p>
                    <p class="text-sm text-muted-foreground">Liked</p>
                </div>

                <div class="bg-card border border-border rounded-xl p-6 text-center shadow-sm">
                    <p class="text-2xl font-bold">{{ $user->favoritePosts()->count() ?? 0 }}</p>
                    <p class="text-sm text-muted-foreground">Saved</p>
                </div>
            </div>

            {{-- ABOUT --}}
            <div class="bg-card rounded-xl border border-border shadow-lg p-6">
                <h2 class="text-lg font-semibold text-primary mb-4">
                    {{ __('public/user.sections.personal') }}
                </h2>

                <p class="text-muted-foreground leading-relaxed">
                    {{ $user->profile?->about_myself ?? __('public/user.general.no_information') }}
                </p>
            </div>

            {{-- SOCIAL LINKS --}}
            @if ($user->profile?->github || $user->profile?->linkedin || $user->profile?->website)
                <div class="bg-card rounded-xl border border-border shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-primary mb-4">
                        {{ __('public/user.sections.social') }}
                    </h2>

                    <div class="flex flex-wrap gap-4">

                        @if ($user->profile?->github)
                            <a href="{{ $user->profile?->github }}" target="_blank"
                                class="bg-background border border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring  rounded-md flex items-center focus:ring focus:outline-none gap-4 p-4">
                                <i class="fab fa-github"></i> GitHub
                            </a>
                        @endif

                        @if ($user->profile?->linkedin)
                            <a href="{{ $user->profile?->linkedin }}" target="_blank"
                                class="bg-background border border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring  rounded-md flex items-center focus:ring focus:outline-none gap-4 p-4">
                                <i class="fab fa-linkedin"></i> LinkedIn
                            </a>
                        @endif

                        @if ($user->profile?->website)
                            <a href="{{ $user->profile?->website }}" target="_blank"
                                class="bg-background border border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring  rounded-md flex items-center focus:ring focus:outline-none gap-4 p-4">
                                <i class="fas fa-link"></i> Website
                            </a>
                        @endif

                    </div>
                </div>
            @endif

        </div>

    </div>

@endsection
