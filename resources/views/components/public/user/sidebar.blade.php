<div class="sticky top-6 space-y-6">
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

        <p class="text-muted-foreground">
            {{ $user->profile?->job_title }}
        </p>

        @if ($user->profile?->address)
            <p class="text-muted-foreground mt-1">
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
                <a href="{{ route('public.user.show', $user) }}" rel="noopener noreferrer"
                    class="{{ Route::currentRouteName() == 'public.user.show' ? 'bg-primary hover:bg-primary/80 text-primary-foreground' : 'bg-background hover:bg-accent hover:text-accent-foreground' }} border border-input  focus-visible:ring-ring rounded-md flex items-center focus:ring focus:outline-none gap-4 p-4">
                    <i class="fas fa-pen text-xl"></i>
                    <div>
                        <p class="text-sm font-semibold">{{ __('public/user.buttons.my_post.title') }}</p>
                        <p class="text-xs font-normal">
                            {{ __('public/user.buttons.my_post.description') }}</p>
                    </div>
                </a>

                <a href="{{ route('public.user.show.liked', $user) }}" rel="noopener noreferrer"
                    class="{{ Route::currentRouteName() == 'public.user.show.liked' ? 'bg-primary hover:bg-primary/80 text-primary-foreground' : 'bg-background hover:bg-accent hover:text-accent-foreground' }} border border-input  focus-visible:ring-ring rounded-md flex items-center focus:ring focus:outline-none gap-4 p-4">
                    <i class="fas fa-heart text-xl"></i>
                    <div>
                        <p class="text-sm font-semibold">{{ __('public/user.buttons.liked_post.title') }}
                        </p>
                        <p class="text-xs font-normal">
                            {{ __('public/user.buttons.liked_post.description') }}</p>
                    </div>
                </a>
                <a href="{{ route('public.user.show.favorites', $user) }}" rel="noopener noreferrer"
                    class="{{ Route::currentRouteName() == 'public.user.show.favorites' ? 'bg-primary hover:bg-primary/80 text-primary-foreground' : 'bg-background hover:bg-accent hover:text-accent-foreground' }} border border-input  focus-visible:ring-ring rounded-md flex items-center focus:ring focus:outline-none gap-4 p-4">
                    <i class="fas fa-bookmark text-xl"></i>
                    <div>
                        <p class="text-sm font-semibold">
                            {{ __('public/user.buttons.favorite_post.title') }}
                        </p>
                        <p class="text-xs font-normal">
                            {{ __('public/user.buttons.favorite_post.description') }}
                        </p>
                    </div>
                </a>

                <a href="{{ route('public.user.settings.personal.index', $user) }}" rel="noopener noreferrer"
                    class="{{ request()->routeIs('public.user.settings.*') == 'public.user.settings.*' ? 'bg-primary hover:bg-primary/80 text-primary-foreground' : 'bg-background hover:bg-accent hover:text-accent-foreground' }} border border-input  focus-visible:ring-ring rounded-md flex items-center focus:ring focus:outline-none gap-4 p-4">
                    <i class="fas fa-cog text-xl"></i>
                    <div>
                        <p class="text-sm font-semibold">{{ __('public/user.buttons.edit_profile.title') }}
                        </p>
                        <p class="text-xs font-normal">
                            {{ __('public/user.buttons.edit_profile.description') }}</p>
                    </div>
                </a>
            </div>
        </div>


        {{-- Дополнительное меню ТОЛЬКО на странице настроек --}}
        @if (request()->routeIs('public.user.settings.*'))
            <div class="bg-card rounded-xl border border-border shadow-lg p-4 space-y-3">
                <h3 class="text-lg font-semibold mb-2">{{ __('public/user.buttons.edit_profile.title') }}</h3>

                <a href="{{ route('public.user.settings.personal.index', $user) }}"
                    class="{{ Route::currentRouteName() == 'public.user.settings.personal.index' ? 'bg-primary hover:bg-primary/80 text-primary-foreground' : 'bg-background hover:bg-accent hover:text-accent-foreground' }} border border-input rounded-md flex items-center gap-4 p-3">
                    <i class="fas fa-user-cog"></i>
                    <span>{{ __('public/user.sections.personal') }}</span>
                </a>
                <a href="{{ route('public.user.settings.security.index', $user) }}"
                    class="{{ Route::currentRouteName() == 'public.user.settings.security.index' ? 'bg-primary hover:bg-primary/80 text-primary-foreground' : 'bg-background hover:bg-accent hover:text-accent-foreground' }} border border-input rounded-md flex items-center gap-4 p-3">
                    <i class="fas fa-shield-alt"></i>
                    <span>{{ __('public/user.sections.security') }}</span>
                </a>
                <a href="{{ route('public.user.settings.session.index', $user) }}"
                    class="{{ Route::currentRouteName() == 'public.user.settings.session.index' ? 'bg-primary hover:bg-primary/80 text-primary-foreground' : 'bg-background hover:bg-accent hover:text-accent-foreground' }} border border-input rounded-md flex items-center gap-4 p-3">
                    <i class="fas fa-desktop"></i>
                    <span>{{ __('public/user.sections.sessions') }}</span>
                </a>
            </div>
        @endif
    @endif

</div>
