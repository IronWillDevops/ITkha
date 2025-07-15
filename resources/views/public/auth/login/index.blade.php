@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">

        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                {{-- Email --}}
                <x-public.form.input.text type="email" name="email" text="{{ __('form.common.email') }}" placeholder="{{ __('form.common.email') }}"
                    icon="fas fa-solid fa-at" />

                {{-- Password --}}
                <x-public.form.input.password name="password" text="{{ __('form.common.password') }}" placeholder="{{ __('form.common.password') }}"
                    icon="fas fa-solid fa-lock" />
                @error('error')
                    <p class="text-error ">{{ $message }}</p>
                @enderror





                <div class="mb-4 flex items-center justify-between">
                    <label class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" value="" class="w-4 h-4 rounded-sm"
                            {{ old('remember') ? 'checked' : '' }}>
                        <span class="ms-2 text-sm font-medium">{{ __('form.common.remember') }}</span>
                    </label>
                    <a href="{{ route('public.auth.forgot.password.index') }}"
                        class="text-sm link link-hover hover:underline">{{ __('form.common.forgot_password') }}

                    </a>
                </div>

                {{-- Кнопка входа --}}
                <x-public.form.input.submit text="{{ __('form.login.submit') }}" />

            </form>

            <p class="mt-4 text-right text-sm text-text-secondary">
                {{ __('form.common.dont_have_account') }}
                <a href="{{ route('public.auth.register.index') }}" class="link link-hover hover:underline">{{ __('form.common.register_now') }}</a>
            </p>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/public/togglePasswordVisibility.js')
@endpush
