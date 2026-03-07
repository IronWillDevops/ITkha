<div class="mt-8 bg-card text-card-foreground border border-border rounded-lg gap-6">
    <div class="flex flex-col items-center justify-center py-20 px-6  rounded-md ">
        <i class="fa-solid fa-circle-exclamation fa-4x mb-4"></i>

        <h2 class="text-2xl font-semibold mb-2">{{ __('public/post.not_found.title') }}</h2>
        <p class="text-muted-foreground">{{ __('public/post.not_found.description') }}.</p>

        <a href="{{ route('public.post.index') }}"
            class="btn btn-shimmer mt-4">
            <i class="fas fa-home mr-4"></i>{{ __('public/post.not_found.return_home') }}
        </a>
    </div>
</div>
