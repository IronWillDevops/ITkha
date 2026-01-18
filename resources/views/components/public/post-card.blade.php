<div
    class="relative overflow-hidden flex w-full flex-col md:flex-row bg-card text-muted-foreground shadow-sm border border-border hover:shadow-md rounded-lg">

    @if ($post->singleMedia('main_image'))
        <div class="relative md:w-2/5 shrink-0 overflow-hidden aspect-[3/2]">
            <img src="{{ $post->singleMedia('main_image')->url }}" alt="card-image"
                class="h-full w-full rounded-md md:rounded-lg object-cover" />
        </div>
    @endif
    <div class="p-6 w-full flex flex-col h-full overflow-hidden">
        <div class="flex justify-between items-center ">

            {{-- Левая часть: --}}
            @if ($post->category)
                <span class="inline-block bg-secondary text-secondary-foreground rounded-full px-3 py-1">
                    <i class="fas fa-tag mr-1"></i>
                    <a href="{{ route('public.post.index', ['search' => $post->category->title]) }}"
                        class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                        {{ $post->category->title }}
                    </a>
                </span>
            @endif

            {{-- Правая часть: Update_at Edit_post --}}
            <div class="flex items-center space-x-4 ">
                {{-- Update_at --}}
                <div class="flex items-center">
                    <div class="inline-flex items-center space-x-1">
                        <i class="fas fa-calendar-day"></i>
                        <span>{{ $post->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                </div>

                {{-- Edit --}}
                @if (Auth::check() && Auth::user()->hasPermission('post.update'))
                    <div class="flex items-center">
                        <a href="{{ route('admin.post.edit', $post) }}"
                            class="text-primary hover:text-primary/80 focus:ring focus:outline-none focus-visible:ring-ring">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <x-public.ui.separator />


        <div class="flex-grow">
            <h4 class="mb-2 text-card-foreground text-xl font-semibold">
                <a href="{{ route('public.post.show', $post) }}"
                    class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                    {!! highlight($post->title, request('search')) !!}
                </a>
            </h4>

            <p class="mb-4 text-muted-foreground leading-normal font-light break-words break-all overflow-hidden">
                {!! highlight(Str::limit(strip_tags(html_entity_decode($post->content)), 450), request('search')) !!}
            </p>

        </div>

        @if ($post->tags && $post->tags->count())
            <div class="flex flex-wrap items-center gap-2 mb-6">
                @foreach ($post->tags as $tag)
                    <span class="inline-block bg-secondary text-secondary-foreground rounded-full px-3 py-1  ">
                        <i class="fas fa-tags mr-1"></i>
                        <a href="{{ route('public.post.index', ['search' => $tag->title]) }}"
                            class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                            {{ $tag->title }}
                        </a>
                    </span>
                @endforeach
            </div>
        @endif


        <x-public.ui.separator />

        <div class="flex justify-between items-center text-muted-foreground flex-wrap gap-4 ">

            {{-- Левая часть: ссылка "Read more" --}}
            <a href="{{ route('public.post.show', $post) }}"
                class="bg-background border-input hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring font-semibold p-2 rounded-sm flex items-center focus:ring focus:outline-none ">
                {{ __('public/post.buttons.read_more') }}
                <i class="fas fa-link ml-2"></i>
            </a>

            {{-- Правая часть: автор, просмотры и лайки --}}
            <div class="flex items-center space-x-4">

                {{-- Автор --}}
                <div class="flex items-center">
                    <i class="fas fa-user mr-1"></i>
                    <a href="{{ route('public.user.show', $post->author) }}"
                        class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                        <span>{!! highlight($post->author->login ?? 'Unknown', request('search')) !!}</span>
                    </a>
                </div>
                {{-- Comments --}}
                <div class="flex items-center">
                    <i class="far fa-comment mr-1"></i>
                    <span>{{ $post->allApprovedComments->count() }}</span>
                </div>

                {{-- View --}}
                <div class="flex items-center">
                    <i class="fas fa-eye mr-1"></i>
                    <span>{{ Number::abbreviate($post->getActualViewsAttribute()) ?? 0 }}</span>
                </div>

                {{-- bookmark --}}
                <livewire:public.favorite-button :post="$post" :key="'post-' . $post->id" />

                {{-- Likes --}}
                <livewire:public.post-like-button :post="$post" :key="'post-like-' . $post->id" />
            </div>
        </div>
    </div>
</div>
