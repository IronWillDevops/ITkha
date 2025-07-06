@extends('public.layouts.app')

@section('public.content')
    <div class="flex flex-col lg:flex-row gap-6  ">
        <div class="w-full lg:w-1/5 flex flex-col gap-6 ">
            <div class="border border-border bg-surface text-text-primary shadow  p-4 rounded-lg">
                <h3 class="text-xl font-semibold mb-4">
                    <i class="fas fa-user mr-3"></i>
                    User Profile
                </h3>
                <div><strong>Name:</strong> {{ $user->name }}</div>
                <div><strong>Surname:</strong> {{ $user->surname ?? '-' }}</div>
                <div><strong>Login:</strong> {{ $user->login }}</div>
                <div><strong>Registered:</strong> {{ $user->created_at->format('d M Y') }}</div>
            </div>
            <div class="border border-border bg-surface text-text-primary shadow  p-4 rounded-lg">
                <h3 class="text-xl font-semibold mb-4">
                    <i class=" fas fa-newspaper mr-3"></i>
                    Top 5 posts
                </h3>
                <ul class="space-y-2">
                    @foreach ($popularPosts as $post)
                        <li>
                            <a href="{{ route('public.post.show', $post->id) }}" class="link link-hover hover:underline">
                                {{ $post->title }}
                            </a>
                            <span class="text-sm text-text-muted">({{ $post->views }} views)</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="w-full lg:w-4/5  flex flex-col gap-6">
            <h3
                class="text-xl font-semibold mb-4 p-4 bg-surface shadow-sm border border-border text-text-primary hover:shadow-md rounded-lg">
                <i class=" fas fa-newspaper mr-3"></i>
                Posts: {{ $user->publishedPosts()->total() }}
            </h3>
            <div class="grid grid-cols-1 2xl:grid-cols-2 gap-6">
                @foreach ($user->publishedPosts() as $post)
                    <x-public.post-card :post="$post" />
                @endforeach
            </div>
            <div class="flex justify-center mt-6">
                {{ $user->publishedPosts()->withQueryString()->links('vendor.pagination.pagination') }}
            </div>
        </div>
    </div>
@endsection
