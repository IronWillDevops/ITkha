@extends('public.layouts.app')

@section('public.content')
    @include('public.partials.filter')
    {{-- Повідомлення, якщо немає постів --}}
    @if ($posts->isEmpty())
        @include('public.partials.not-found')
    @endif

    <div class="grid grid-cols-1 2xl:grid-cols-2 gap-6">
        {{-- Posts --}}
        @foreach ($posts as $post)
            <div
                class="relative flex w-full flex-col md:flex-row bg-surface shadow-sm border border-border text-text-primary hover:shadow-md rounded-lg">

                @if (!empty($post->main_image) && Storage::disk('public')->exists($post->main_image))
                    <div class="relative  md:w-2/5 shrink-0 overflow-hidden aspect-[3/2]">
                        <img src="{{ asset('storage/' . $post->main_image) }}" alt="card-image"
                            class="h-full w-full rounded-md md:rounded-lg object-cover" />
                    </div>
                @endif
                <div class="p-6 w-full flex flex-col h-full">
                    <div class="flex justify-between items-center mb-6">

                        {{-- Левая часть: ссылка "Read more" --}}

                        <span class="inline-block  post-category rounded-full px-3 py-1 text-sm font-semibold  ">
                            <i class="fas fa-tag mr-1"></i>
                            {{ $post->category->title }}

                        </span>

                        {{-- Правая часть: автор, просмотры и лайки --}}
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

                    <hr class="separator">


                    <div class="flex-grow">
                        <h4 class="m-2 post-header post-header-hover font-semibold">
                            <a href="{{ route('public.post.show', $post->id) }}" class="hover:underline">
                                {!! highlight($post->title, request('search')) !!}
                            </a>
                        </h4>

                        <p class="mb-4 post-content  leading-normal font-light break-words">
                            {!! highlight(Str::limit(strip_tags(html_entity_decode($post->content)), 450), request('search')) !!}
                        </p>

                    </div>

                    @if ($post->tags && $post->tags->count())
                        <div class="flex flex-wrap items-center post-tag space-x-4 mb-6">
                            @foreach ($post->tags as $tag)
                                <span class="border rounded-2xl px-3 py-0.5 mx-3 flex items-center">
                                    <i class="fas fa-tags"></i>
                                    <span class="font-medium ml-2">{{ $tag->title }}</span>
                                </span>
                            @endforeach
                        </div>
                    @endif


                    <hr class="separator">

                    <div class="flex justify-between items-center mt-4">

                        {{-- Левая часть: ссылка "Read more" --}}
                        <a href="{{ route('public.post.show', $post->id) }}"
                            class="link link-hover font-semibold text-sm  flex items-center">
                            Read more
                            <i class="fas fa-link ml-2"></i>
                        </a>

                        {{-- Правая часть: автор, просмотры и лайки --}}
                        <div class="flex items-center space-x-4 post-footer ">

                            {{-- Автор --}}
                            <div class="flex items-center">
                                <i class="fas fa-user mr-1"></i>
                                <a href="{{ route('public.user.show', $post->author->id) }}"
                                    class="link-hover hover:underline">
                                    <span>{!! highlight($post->author->login ?? 'Unknown', request('search')) !!}</span>
                                </a>
                            </div>

                            {{-- Просмотры --}}
                            <div class="flex items-center">
                                <i class="fas fa-eye mr-1"></i>
                                <span>{{ Number::abbreviate($post->views) ?? 0 }}</span>
                            </div>

                            {{-- Лайки --}}
                            @auth
                                <form method="POST" action="{{ route('public.post.like', $post) }}" class="like-form"
                                    data-post-id="{{ $post->id }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center {{ auth()->user()->likedPosts->contains($post->id) ? 'post-like' : 'post-like-hover' }} like-button">
                                        <i class="fas fa-heart mr-1"></i>
                                        <span
                                            class="like-count">{{ Number::abbreviate($post->likedByUsers->count()) ?? 0 }}</span>
                                    </button>
                                </form>
                            @else
                                <i class="fas fa-heart mr-1"></i>
                                <span>{{ Number::abbreviate($post->likedByUsers->count()) ?? 0 }}</span>
                            @endauth


                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div class="flex justify-center mt-6">
        {{ $posts->withQueryString()->links('vendor.pagination.pagination') }}
    </div>
@endsection



@push('scripts')
    @vite('resources/js/public/like.js')
@endpush
