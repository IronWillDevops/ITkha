@extends('public.layouts.user')

@section('public.content')
    <h3
        class="text-xl font-semibold mb-4 p-4 bg-card shadow-sm border border-border text-card-foreground hover:shadow-md rounded-lg">
        <i class=" fas fa-newspaper mr-3"></i>
        {{ __('public/post.title') }}: {{ $posts->total() }}
    </h3>
    <div class="grid grid-cols-1 2xl:grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <x-public.post-card :post="$post" />
        @endforeach
    </div>
    <div class="flex justify-center mt-6">
        {{ $posts->withQueryString()->links('vendor.pagination.pagination') }}
    </div>
@endsection
