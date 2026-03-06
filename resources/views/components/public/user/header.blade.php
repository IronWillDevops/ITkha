 {{-- RIGHT CONTENT --}}
 <div class="lg:col-span-3 space-y-6">
     {{-- STATISTICS --}}
     @if (auth()->check() && auth()->id() === $user->id)
         <div class="grid grid-cols-3 gap-6">
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
     @endif
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
                         class="btn btn-shimmer gap-4 p-4">
                         <i class="fab fa-github"></i>GitHub
                     </a>
                 @endif

                 @if ($user->profile?->linkedin)
                     <a href="{{ $user->profile?->linkedin }}" target="_blank"
                         class="btn btn-shimmer gap-4 p-4">
                         <i class="fab fa-linkedin"></i>LinkedIn
                     </a>
                 @endif

                 @if ($user->profile?->website)
                     <a href="{{ $user->profile?->website }}" target="_blank"
                         class="btn btn-shimmer gap-4 p-4">
                         <i class="fas fa-link"></i>Website
                     </a>
                 @endif

             </div>
         </div>
     @endif

 </div>
