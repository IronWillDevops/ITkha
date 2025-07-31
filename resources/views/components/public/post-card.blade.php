<div
    class="relative overflow-hidden flex w-full flex-col md:flex-row bg-surface shadow-sm border border-border text-text-primary hover:shadow-md rounded-lg">

    @if (!empty($post->main_image) && Storage::disk('public')->exists($post->main_image))
        <div class="relative  md:w-2/5 shrink-0 overflow-hidden aspect-[3/2]">
            <img src="{{ asset('storage/' . $post->main_image) }}" alt="card-image"
                class="h-full w-full rounded-md md:rounded-lg object-cover" />
        </div>
    @endif
    <div class="p-6 w-full flex flex-col h-full overflow-hidden">
        <div class="flex justify-between items-center ">

            {{-- Левая часть: --}}
            <span class="inline-block  post-category rounded-full px-3 py-1 text-sm font-semibold  ">
                <i class="fas fa-tag mr-1"></i>
                {{ $post->category->title }}
            </span>

            {{-- Правая часть: Update_at Edit_post --}}
            <div class="flex items-center space-x-4 post-footer ">
                {{-- Update_at --}}
                <div class="flex items-center">
                    <div class="inline-flex items-center space-x-1">
                        <i class="fas fa-calendar-day"></i>
                        <span>{{ $post->updated_at->format('d.m.Y H:i') }}</span>
                    </div>
                </div>

                {{-- Edit --}}
                @if (Auth::check() && Auth::user()->hasPermission('posts_edit'))
                    <div class="flex items-center">
                        <a href="{{ route('admin.post.edit', $post->id) }}" class="link link-hover">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <x-public.ui.separator />


        <div class="flex-grow">
            <h4 class="mb-2 post-header post-header-hover font-semibold">
                <a href="{{ route('public.post.show', $post->id) }}" class="hover:underline">
                    {!! highlight($post->title, request('search')) !!}
                </a>
            </h4>

            <p class="mb-4 post-content  leading-normal font-light break-words break-all overflow-hidden">
                {!! highlight(Str::limit(strip_tags(html_entity_decode($post->content)), 450), request('search')) !!}
            </p>

        </div>

        @if ($post->tags && $post->tags->count())
            <div class="flex flex-wrap items-center gap-2 mb-6">
                @foreach ($post->tags as $tag)
                    <span class="border rounded-2xl px-3 py-0.5  flex items-center">
                        <i class="fas fa-tags"></i>
                        <span class="font-medium ml-2">{{ $tag->title }}</span>
                    </span>
                @endforeach
            </div>
        @endif


        <x-public.ui.separator />

        <div class="flex justify-between items-center  flex-wrap gap-4 text-sm">

            {{-- Левая часть: ссылка "Read more" --}}
            <a href="{{ route('public.post.show', $post->id) }}"
                class="link link-hover font-semibold text-sm  flex items-center">
                {{ __('post.read_more') }}
                <i class="fas fa-link ml-2"></i>
            </a>

            {{-- Правая часть: автор, просмотры и лайки --}}
            <div class="flex items-center space-x-4 post-footer ">

                {{-- Автор --}}
                <div class="flex items-center">
                    <i class="fas fa-user mr-1"></i>
                    <a href="{{ route('public.user.show', $post->author->id) }}" class="link-hover hover:underline">
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
                    <span>{{ Number::abbreviate($post->views) ?? 0 }}</span>
                </div>

                {{-- bookmark --}}
                <livewire:public.favorite-button :post="$post" :key="'post-' . $post->id" />

                {{-- Likes --}}
                <livewire:public.post-like-button :post="$post" :key="'post-like-' . $post->id" />
            </div>
        </div>
    </div>
</div>
