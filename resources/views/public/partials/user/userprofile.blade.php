 <div class="bg-card text-card-foreground rounded-2xl border border-border shadow p-4">
     <!-- Name and title with staggered animation -->

     <div class="text-center mb-4">
      
         <div class="avatar m-4 ">
             @if ($user->avatar)
                 <img type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
                     class="relative inline-flex items-center justify-center w-24 h-24 object-cover rounded-full border border-border"
                     src="{{ asset('storage/' . $user->avatar) }}" data-filename="image.png" alt="{{ $user->first_name }}">
             @else
                 <div
                     class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden rounded-full border border-border">
                     <span class="font-bold text-4xl">
                         {{ $user->getInitial() }}
                     </span>
                 </div>
             @endif

         </div>
         <h2 class=" text-2xl font-bold animate-fade-in ">{{ $user->first_name }} {{ $user->last_name }}</h2>
         <p class="font-light text-muted-foreground">{{ $user->profile?->job_title }}</p>

         @if ($user->profile?->address)
             <p class="font-light text-muted-foreground"><i class="fas fa-map-marker-alt mr-1"></i>
                 {{ $user->profile?->address }}</p>
         @endif

     </div>

     <!-- Bio section with fade-in -->
     <div class="mb-6 animate-fade-in delay-300">
         <p class="text-muted-foreground leading-relaxed">
             {{ $user->profile?->about_myself }}
         </p>
     </div>

     <x-public.ui.separator />

     <!-- Social icons with hover animation -->
     <div class="flex justify-center space-x-6">

         @if ($user->profile?->github)
             <a href="{{ $user->profile?->github }}"
                 class="flex items-center justify-center w-10 h-10 bg-link hover:bg-accent/80 hover:text-accent-foreground border border-input transition rounded-sm focus:ring focus:outline-none focus-visible:ring-ring"
                 target="_blank">
                 <i class="fab fa-github"></i>
             </a>
         @endif

         @if ($user->profile?->linkedin)
             <a href="{{ $user->profile?->linkedin }}"
                 class="flex items-center justify-center w-10 h-10 bg-link hover:bg-accent/80 hover:text-accent-foreground border border-input transition rounded-sm focus:ring focus:outline-none focus-visible:ring-ring"
                 target="_blank">
                 <i class="fab fa-linkedin"></i>
             </a>
         @endif

         @if ($user->profile?->website)
             <a href="{{ $user->profile?->website }}"
                 class="flex items-center justify-center w-10 h-10 bg-link hover:bg-accent/80 hover:text-accent-foreground border border-input transition rounded-sm focus:ring focus:outline-none focus-visible:ring-ring"
                 target="_blank">
                 <i class="fas fa-link"></i>
             </a>
         @endif
     </div>

     @if (Auth::check() && Auth::user()->id == $user->id)
         <x-public.ui.separator />
         <!-- User action cards (1 col on mobile, 2 cols on md+) -->
         <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4 ">
             <a href="{{ route('public.user.show', $user) }}"
                 class="bg-background border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring  rounded-sm flex items-center focus:ring focus:outline-none gap-4 p-4">
                 <i class="fas fa-pen text-xl"></i>
                 <div>
                     <p class="text-sm font-semibold">{{ __('public/user.buttons.my_post.title') }}</p>
                     <p class="text-xs text-muted-foreground font-normal">
                         {{ __('public/user.buttons.my_post.description') }}</p>
                 </div>
             </a>

             <a href="{{ route('public.user.show.like', $user) }}"
                 class="bg-background border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring  rounded-sm flex items-center focus:ring focus:outline-none gap-4 p-4">
                 <i class="fas fa-heart text-xl"></i>
                 <div>
                     <p class="text-sm font-semibold">{{ __('public/user.buttons.liked_post.title') }}
                     </p>
                     <p class="text-xs text-muted-foreground font-normal">
                         {{ __('public/user.buttons.liked_post.description') }}</p>
                 </div>
             </a>
             <a href="{{ route('public.user.show.favorite', $user) }}"
                 class="bg-background border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring  rounded-sm flex items-center focus:ring focus:outline-none gap-4 p-4">
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

             <a href="{{ route('public.user.edit', $user) }}"
                 class="bg-background border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring  rounded-sm flex items-center focus:ring focus:outline-none gap-4 p-4">
                 <i class="fas fa-cog text-xl"></i>
                 <div>
                     <p class="text-sm font-semibold">{{ __('public/user.buttons.edit_profile.title') }}
                     </p>
                     <p class="text-xs text-muted-foreground font-normal">
                         {{ __('public/user.buttons.edit_profile.description') }}</p>
                 </div>
             </a>
         </div>
     @endif
 </div>
