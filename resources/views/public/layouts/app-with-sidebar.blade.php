@extends('public.layouts.app')

@section('public.layouts')
    <div class="flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-4/5">
            @yield('public.content') {{-- основний контент сторінки --}}
        </div>
        <aside class="w-full lg:w-1/5">
            @include('public.partials.sidebar')
        </aside>
    </div>
@endsection