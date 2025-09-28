<div class="min-w-3xs flex flex-col  bg-card text-card-foreground  gap-6 ">
    <div class="border border-border  shadow  p-4 rounded-lg">
        <h3 class="text-xl font-semibold mb-4">
            <i class="icon fa fa-newspaper mr-3"></i>
            {{ __('post.popular_posts') }}
        </h3>
        <x-public.ui.separator />
        <ul class="space-y-2">
            @foreach ($popularPosts as $post)
                <li>
                    <div class="mb-4 flex flex-col ">
                        <span class="text-xs text-muted-foreground">{{ $post->created_at->format('d/m/Y') }}</span>
                        <a href="{{ route('public.post.show', $post->id) }}"
                            class=" hover:underline focus:ring focus:outline-none focus-visible:ring-ring">{{ $post->title }}</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
