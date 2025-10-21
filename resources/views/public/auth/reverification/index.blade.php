@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold mb-2">{{ __('public/verify.title') }}</h2>
                <span class="text-sm text-muted-foreground">{{ __('public/verify.description') }}</span>
            </div>
            <form method="POST" action="{{ route('public.auth.reverification.store') }}">
                @csrf

                {{-- Email --}}
                <x-public.form.input type="email" name="email" label="{{ __('public/common.fields.email') }}"
                    placeholder="{{ __('public/common.placeholder.email') }}" icon="fas fa-solid fa-at" />

                {{-- Submit --}}
                <x-public.form.submit label="{{ __('public/verify.submit') }}" class="w-full"/>

            </form>


        </div>
    </div>
@endsection
