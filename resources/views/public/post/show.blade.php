@extends('public.layouts.app-with-sidebar')

@section('public.content')
    <div class="flex flex-col gap-6">
        <article class="w-full bg-card text-muted-foreground rounded-2xl border border-border">

            @if (!empty($post->main_image) && Storage::disk('public')->exists($post->main_image))
                <div class="w-full h-64 object-cover">
                    <img src="{{ asset('storage/' . $post->main_image) }}" alt="card-image"
                        class="h-full w-full rounded-md md:rounded-lg object-cover" />
                </div>
            @endif

            <div class="p-6 space-y-6">
                <h1 class="text-card-foreground text-3xl font-bold">{{ $post->title }}
                    @if (Auth::check() && Auth::user()->hasPermission('posts_edit'))
                        <a href="{{ route('admin.post.edit', $post) }}" class="text-primary hover:text-primary/80 focus:ring focus:outline-none focus-visible:ring-ring">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    @endif
                </h1>

                <div class="flex flex-wrap items-center text-sm space-x-4 ">
                    <div class="inline-flex items-center space-x-1">
                        <i class="fas fa-calendar-day"></i>
                        <span>{{ $post->created_at->format('d/m/Y') }}</span>
                    </div>

                    <span>|</span>

                    <span class="inline-flex items-center">
                        <i class="fas fa-tag "></i>
                        <span class="font-medium ml-2">{{ $post->category->title }}</span>
                    </span>

                    <span>|</span>

                    <span class="inline-flex items-center">
                        <i class="fa fa-user "></i>
                        <a href="{{ route('public.user.show', $post->author) }}"
                            class="hover:underline ml-2  focus:ring focus:outline-none focus-visible:ring-ring">
                            {{ $post->author->login }}
                        </a>
                    </span>

                    <span>|</span>
                    <span class="inline-flex items-center">
                        <i class="far fa-comment "></i>
                        <span class="font-medium ml-2">{{ $post->allApprovedComments->count() }}</span>
                    </span>
                    <span>|</span>
                    <span class="inline-flex items-center">
                        <i class="fa fa-eye "></i>
                        <span class="font-medium ml-2">{{ Number::abbreviate($post->actual_views) }}</span>
                    </span>
                    <span>|</span>

                    <livewire:public.favorite-button :post="$post" />
                    <span>|</span>

                    <span class="inline-flex items-center">
                        {{-- Likes --}}
                        <livewire:public.post-like-button :post="$post" :key="'post-like-' . $post->id" />
                    </span>
                </div>


                @if ($post->tags && $post->tags->count())
                    <div class="flex flex-wrap items-center post-tag text-sm  space-x-4">
                        @foreach ($post->tags as $tag)
                            <span class="border rounded-2xl px-3 py-0.5 mx-3 flex items-center">
                                <i class="fas fa-tags"></i>
                                <span class="font-medium ml-2">{{ $tag->title }}</span>
                            </span>
                        @endforeach
                    </div>
                @endif

                <x-public.ui.separator />
                
                <div id="post-content" class="prose max-w-none prose-lg prose-gray wrap-anywhere">
                    {!! $post->content !!}
                </div>
            </div>
        </article>

        {{-- Similar Posts --}}
        @if ($similarPosts->isNotEmpty())
            @include('public.partials.similarPost')
        @endif

        {{-- Comments --}}
        @include('public.partials.comment.index')


    </div>
@endsection
