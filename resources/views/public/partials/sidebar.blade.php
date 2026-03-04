<div class="top-6  min-w-3xs flex flex-col gap-6 ">
    <div class=" bg-card text-card-foreground border border-border  shadow  p-4 rounded-lg">
        <h3 class="text-xl font-semibold mb-4">
            <i class="icon fa fa-newspaper"></i>
            <span>{{ __('public/post.labels.popular_posts') }}</span>
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

    <div class="top-6 min-w-3xs flex flex-col gap-6">

        {{-- Категорії --}}
        @if ($categories->isNotEmpty())
            <div class="bg-card text-card-foreground border border-border shadow p-4 rounded-lg">
                <h3 class="text-xl font-semibold mb-4">
                    <i class="fa-solid fa-folder-open"></i>
                        <span>{{ __('public/category.title') }}</span>
                </h3>

                <x-public.ui.separator />

                <div class="flex flex-wrap gap-2">
                    @foreach ($categories as $category)
                        <a href="{{ route('public.post.index', ['search' => $category->title]) }}"
                            class="px-3 py-1 text-sm border border-border rounded-full 
                              hover:bg-primary/80 hover:text-primary-foreground transition flex items-center gap-1">
                            <span>{{ $category->title }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Теги --}}
        @if ($tags->isNotEmpty())
            <div class="bg-card text-card-foreground border border-border shadow p-4 rounded-lg">
                <h3 class="text-xl font-semibold mb-4">
                    <i class="fa-solid fa-tags"></i>
                    <span>{{ __('public/tag.title') }}</span>
                </h3>

                <x-public.ui.separator />

                <div class="flex flex-wrap gap-2">
                    @foreach ($tags as $tag)
                        <a href="{{ route('public.post.index', ['search' => $tag->title]) }}"
                            class="px-3 py-1 text-sm border border-border rounded-full hover:bg-primary/80 hover:text-primary-foreground transition">
                            {{ $tag->title }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

    @if ($latestComment->isNotEmpty())
        <div class=" bg-card text-card-foreground border border-border  shadow  p-4 rounded-lg">
            <h3 class="text-xl font-semibold mb-4">
                <i class="fa-solid fa-comments"></i>
                <span>{{ __('public/comment.labels.latest_comment') }}</span>
            </h3>
            <x-public.ui.separator />
            <ul class="space-y-2">
                @foreach ($latestComment as $comment)
                    <li>
                        <div class="mb-4 flex flex-col ">
                            <span
                                class="text-xs text-muted-foreground">{{ $comment->created_at->diffForHumans() }}</span>
                            <a href="{{ route('public.post.show', $comment->post) }}"
                                class=" hover:underline focus:ring focus:outline-none focus-visible:ring-ring break-all">{{ Str::limit(strip_tags(html_entity_decode($comment->body)), 50) }}</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif


</div>
