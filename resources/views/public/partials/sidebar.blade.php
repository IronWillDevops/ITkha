<div class="min-w-3xs flex flex-col gap-6 ">
    <div class=" bg-card text-card-foreground border border-border  shadow  p-4 rounded-lg">
        <h3 class="text-xl font-semibold mb-4">
            <i class="icon fa fa-newspaper"></i>
            <span>{{ __('public/post.popular_posts') }}</span>
        </h3>
        <x-public.ui.separator />
        <ul class="space-y-2">
            @foreach ($popularPosts as $post)
                <li>
                    <div class="mb-4 flex flex-col ">
                        <span class="text-xs text-muted-foreground">{{ $post->created_at->format('d/m/Y') }}</span>
                        <a href="{{ route('public.post.show', $post) }}"
                            class=" hover:underline focus:ring focus:outline-none focus-visible:ring-ring">{{ $post->title }}</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
        <div class=" bg-card text-card-foreground border border-border  shadow  p-4 rounded-lg">
            <h3 class="text-xl font-semibold mb-4">
                <i class="fa-solid fa-comments"></i>
                <span>{{ __('public/comment.latest_comment') }}</span>
            </h3>
            <x-public.ui.separator />
            <ul class="space-y-2">
                @foreach ($latestComment as $comment)
                    <li>
                        <div class="mb-4 flex flex-col ">
                            <span
                                class="text-xs text-muted-foreground">{{ $comment->created_at->diffForHumans() }}</span>
                            <a href="{{ route('public.post.show',$comment->post) }}"
                                class=" hover:underline focus:ring focus:outline-none focus-visible:ring-ring break-all">{{ Str::limit(strip_tags(html_entity_decode($comment->body)), 50) }}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

</div>
