@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">

        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>
            <p class="mb-2 text-sm">{{ __('form.reset.different_password') }}</p>
            <form method="POST" action="{{ route('public.auth.reset.password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">



                {{-- Password --}}
                <x-public.form.input.password name="password" text="{{ __('form.common.password') }}" placeholder="{{ __('form.common.password') }}"
                    icon="fas fa-solid fa-lock" />

                {{-- Password confirmation --}}
                <x-public.form.input.password name="{{ __('form.common.password_repeat') }}" text="{{ __('form.common.password_repeat') }}"
                    placeholder="Repeat new password" icon="fas fa-solid fa-lock" />

                {{-- Submit --}}
                <x-public.form.input.submit text="{{ __('form.reset.submit') }}" />

            </form>
            <div class="mb-4">
                <p class="mt-4  text-right text-sm text-text-secondary">
                    {{ __('form.common.remember_your_password') }}
                    <a href="{{ route('login') }}" class="link link-hover hover:underline">{{ __('form.login.submit') }}</a>
                </p>
            </div>

        </div>
    </div>
@endsection

