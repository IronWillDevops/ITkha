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
            <x-public.post-card :post="$post"/>
        @endforeach

    </div>

    <div class="flex justify-center mt-6">
        {{ $posts->withQueryString()->links('vendor.pagination.pagination') }}
    </div>
@endsection



@push('scripts')
    @vite('resources/js/public/like.js')
@endpush
