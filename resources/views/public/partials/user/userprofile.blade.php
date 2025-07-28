 <div class="border border-border bg-surface text-text-primary shadow  p-4 rounded-lg">
     <!-- Name and title with staggered animation -->

     <div class="text-center mb-4">
         <div class="avatar m-4  ">
             @if ($user->avatar)
                 <img type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
                     class="relative inline-flex items-center justify-center w-24 h-24 object-cover rounded-full border border-border"
                     src="{{ asset('storage/' . $user->avatar) }}" data-filename="image.png" alt="{{ $user->name }}">
             @else
                 <div
                     class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden rounded-full border border-border">
                     <span class="font-bold">
                         {{ $user->getInitial() }}
                     </span>
                 </div>
             @endif

         </div>
         <h2 class=" text-2xl font-bold animate-fade-in ">{{ $user->name }} {{ $user->surname }}</h2>
         <p class="font-light">{{ $user->profile?->job_title }}</p>
         <p class="font-light">{{ $user->profile?->address }}</p>
     </div>

     <!-- Bio section with fade-in -->
     <div class="mb-6 animate-fade-in delay-300">
         <p class="text-text-secondary leading-relaxed">
             {{ $user->profile?->about_myself }}
         </p>
     </div>

     <x-public.ui.separator />

     <!-- Social icons with hover animation -->
     <div class="flex justify-center space-x-6">

         @if ($user->profile?->github)
             <a href="{{ $user->profile?->github }}" target="_blank">
                 <i class="fab fa-github"></i>
             </a>
         @endif
         @if ($user->profile?->linkedin)
             <a href="{{ $user->profile?->linkedin }}" target="_blank">
                 <i class="fab fa-linkedin"></i>
             </a>
         @endif
         @if ($user->profile?->website)
             <a href="{{ $user->profile?->website }}" target="_blank">
                 <i class="fas fa-link"></i>
             </a>
         @endif
     </div>

     @if (Auth::check() && Auth::user()->id == $user->id)
         <x-public.ui.separator />
         <!-- User action cards (1 col on mobile, 2 cols on md+) -->
         <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-4 animate-fade-in delay-500">
             <a href="{{ route('public.user.show', $user->id) }}"
                 class="flex items-center gap-4 p-4 rounded-xl border transition">
                 <i class="fas fa-pen text-xl"></i>
                 <div>
                     <p class="text-sm font-semibold text-text-primary">{{ __('profile.actions.my_posts.title') }}</p>
                     <p class="text-xs text-text-secondary">{{ __('profile.actions.my_posts.description') }}</p>
                 </div>
             </a>

             <a href="{{ route('public.user.show.like', $user->id) }}"
                 class="flex items-center gap-4 p-4 rounded-xl border transition">
                 <i class="fas fa-heart text-xl"></i>
                 <div>
                     <p class="text-sm font-semibold text-text-primary">{{ __('profile.actions.liked_posts.title') }}
                     </p>
                     <p class="text-xs text-text-secondary">{{ __('profile.actions.liked_posts.description') }}</p>
                 </div>
             </a>    
             <a href="{{ route('public.user.show.favorite', $user->id) }}"
                 class="flex items-center gap-4 p-4 rounded-xl border transition">
                 <i class="fas fa-bookmark text-xl"></i>
                 <div>
                     <p class="text-sm font-semibold text-text-primary">{{ __('profile.actions.favorite_posts.title') }}
                     </p>
                     <p class="text-xs text-text-secondary">{{ __('profile.actions.favorite_posts.description') }}</p>
                 </div>
             </a>

             <a href="{{ route('public.user.edit', $user->id) }}"
                 class="flex items-center gap-4 p-4 rounded-xl border transition">
                 <i class="fas fa-cog text-xl"></i>
                 <div>
                     <p class="text-sm font-semibold text-text-primary">{{ __('profile.actions.edit_profile.title') }}
                     </p>
                     <p class="text-xs text-text-secondary">{{ __('profile.actions.edit_profile.description') }}</p>
                 </div>
             </a>
         </div>
     @endif
 </div>
