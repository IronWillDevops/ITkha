@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            @include('components.public.user.sidebar', ['user' => $user])
        </div>

        {{-- Контент --}}
        <div class="lg:col-span-3 space-y-6 ">
            @include('components.public.user.header', ['user' => $user])
            <div class="bg-card rounded-xl border border-border shadow-lg p-6">
                <h2 class="text-lg font-semibold text-primary mb-4">
                    {{ __('public/user.buttons.liked_post.title') }}
                </h2>

                <div class="grid grid-cols-1 2xl:grid-cols-2 gap-6">
                    @foreach ($posts as $post)
                        <x-public.post-card :post="$post" />
                    @endforeach
                </div>
                <div class="flex justify-center mt-6">
                    {{ $posts->withQueryString()->links('vendor.pagination.pagination') }}
                </div>
            </div>
        </div>

    </div>
@endsection
