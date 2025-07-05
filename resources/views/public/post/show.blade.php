@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary flex flex-col gap-6">
        <article class="w-full  bg-surface  rounded-2xl border border-border">

            @if (!empty($post->main_image) && Storage::disk('public')->exists($post->main_image))
                <div class="w-full h-64 object-cover">
                    <img src="{{ asset('storage/' . $post->main_image) }}" alt="card-image"
                        class="h-full w-full rounded-md md:rounded-lg object-cover" />
                </div>
            @endif

            <div class="p-6 space-y-6">
                <h1 class="post-header text-3xl font-bold">{{ $post->title }}
                    @if (Auth::check() && Auth::user()->hasPermission('posts_edit'))
                        <a href="{{ route('admin.post.edit', $post->id) }}" class="link link-hover">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    @endif
                </h1>
                {{-- Edit --}}

                <div class="flex items-center">

                </div>


                <div class="flex flex-wrap items-center text-sm space-x-4 post-footer">
                    <div class="inline-flex items-center space-x-1">
                        <i class="fas fa-calendar-day"></i>
                        <span>{{ $post->updated_at->format('d/m/Y') }}</span>
                    </div>

                    <span>|</span>

                    <span class="inline-flex items-center">
                        <i class="fas fa-tag ml-2"></i>
                        <span class="font-medium ml-2">{{ $post->category->title }}</span>
                    </span>

                    <span>|</span>

                    <span class="inline-flex items-center">
                        <i class="fa fa-user ml-2"></i>
                        <a href="{{ route('public.user.show', $post->author->id) }}"
                            class="link-hover hover:underline ml-2">
                            {{ $post->author->login }}
                        </a>
                    </span>

                    <span>|</span>

                    <span class="inline-flex items-center">
                        <i class="fa fa-eye ml-2"></i>
                        <span class="font-medium ml-2">{{ Number::abbreviate($post->views) }}</span>
                    </span>

                    <span>|</span>

                    <span class="inline-flex items-center">
                        {{-- Лайки --}}
                        @auth
                            <form method="POST" action="{{ route('public.post.like', $post) }}" class="like-form"
                                data-post-id="{{ $post->id }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center {{ auth()->user()->likedPosts->contains($post->id) ? 'post-like' : 'post-like-hover' }} like-button">
                                    <i class="fas fa-heart mr-1"></i>
                                    <span class="like-count">{{ Number::abbreviate($post->likedByUsers->count()) ?? 0 }}</span>
                                </button>
                            </form>
                        @else
                            <i class="fas fa-heart mr-1"></i>
                            <span>{{ Number::abbreviate($post->likedByUsers->count()) ?? 0 }}</span>
                        @endauth
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

                <hr class="border-border">
                <div id="post-content" class="prose max-w-none prose-lg prose-gray post-content  wrap-anywhere">
                    {!! $post->content !!}
                </div>
            </div>
        </article>

        {{-- Similar Posts --}}
        @if ($similarPosts->isNotEmpty())
            @include('public.partials.similarPost')
        @endif


    </div>


@endsection

@push('scripts')
    @vite('resources/js/public/like.js')
@endpush
