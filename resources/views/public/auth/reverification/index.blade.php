@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>
            <p class=" text-muted mb-6">
                {{ __('form.verify.info') }}
            </p>
            <form method="POST" action="{{ route('public.auth.reverification.store') }}">
                @csrf

                 {{-- Email --}}
                <x-public.form.input.text type="email" name="email" text="{{ __('form.common.email') }}" placeholder="{{ __('form.common.email') }}"
                    icon="fas fa-solid fa-at" />

                {{-- Submit --}}
                <x-public.form.input.submit text="{{ __('form.verify.submit') }}" />
                
            </form>


        </div>
    </div>
@endsection
