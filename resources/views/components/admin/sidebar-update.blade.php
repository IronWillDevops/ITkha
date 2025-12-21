 @if ($isUpdateAvailable)
    <div class="bg-card text-card-foreground  hover:bg-accent hover:text-accent-foreground border border-border shadow hover:shadow-md rounded-lg p-4 mt-4">
        
         <a href="{{ $releaseUrl }}" target="_blank" class="flex items-center space-x-4 focus:ring focus:outline-none focus-visible:ring-ring ">
             <div class="flex items-center space-x-4">
                 <div
                     class="relative inline-flex items-center justify-center w-10 h-10 rounded-full border border-border">
                     <span class="font-bold">!</span>
                 </div>
                 <div>
                     <p class="text-sm font-semibold">{{ __('admin/update.new_version') }}</p>
                     <p class="text-xs text-muted-foreground">
                         {{ __('admin/update.current_latest', ['current' => $currentVersion, 'latest' => $latestVersion]) }}
                     </p>
                     <p class="text-xs link link-hover underline">{{ __('admin/update.view_on_github') }}</p>
                 </div>
             </div>
         </a>

     </div>
 @endif
