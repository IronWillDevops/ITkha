<div class="min-w-3xs flex flex-col text-text-primary  gap-6 ">
    <div class="border border-border bg-surface  shadow  p-4 rounded-lg">
        <h3 class="text-xl font-semibold mb-4">
            <i class="icon fa fa-newspaper mr-3"></i>
            Popular posts
        </h3>
        <hr class="h-px my-8 separator">
        <ul class="space-y-2">
            @foreach ($popularPosts as $post)
                <li>
                    <div class="mb-4 flex flex-col ">
                        <span class="text-xs text-text-secondary">{{ $post->created_at->format('d/m/Y') }}</span>
                        <a href="{{ route('public.post.show', $post->id) }}"
                            class="link link-hover hover:underline">{{ $post->title }}</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>