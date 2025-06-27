@extends('public.layouts.app')

@section('public.content')
    <div class="rounded border border-border bg-surface text-text-primary px-4 shadow-md sm:mx-auto">
        <div class="mb-2 flex flex-col gap-y-6 py-8 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center">
                <div class="ml-4 w-56">
                    <p class="text-xl font-extrabold">{{ $user->name }} &#64;{{ $user->login }}</p>
                    <p>{{ $user->roles->first()?->title }}</p>
                    <p>Joined at: {{ $user->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>
        </div>
        <hr class="separator">
        <div class="mb-2 flex justify-evenly gap-x-8 px-8 py-8 text-sm sm:text-base">
            <div class="flex flex-col items-center">
                <p class="mb-1 text-xl font-extrabold">{{ $user->posts->count() }}</p>
                <p class="text-sm font-medium">Posts</p>
            </div>
        </div>
        <hr class="separator">


        <div class="py-8">
            <h3 class="text-lg font-semibold mb-2">Top 5 Popular Posts</h3>

            @if ($popularPosts->isEmpty())
                <p >No popular posts yet.</p>
            @else
                <ul class="space-y-2">
                    @foreach ($popularPosts as $post)
                        <li>
                            <a href="{{ route('public.post.show', $post->id) }}" class="link link-hover hover:underline">
                                {{ $loop->iteration }}. {{ $post->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
@endsection
