@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="text-card-foreground bg-card max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">

        <div class="w-full max-w-md p-8 rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>
            <p class="mb-2 text-sm text-muted-foreground">{{ __('form.reset.different_password') }}</p>
            <form method="POST" action="{{ route('public.auth.reset.password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                {{-- Password --}}
                <x-public.form.password name="password" label="{{ __('form.common.password') }}"
                    placeholder="{{ __('form.common.password') }}" />

                {{-- Password confirmation --}}
                <x-public.form.password name="password_confirmation" label="{{ __('form.common.password_repeat') }}"
                    placeholder="{{ __('form.common.password') }}" />
                {{-- Submit --}}
                <x-public.form.submit label="{{ __('form.reset.submit') }}" />


            </form>
            <div class="mb-4">
                <p class="mt-4  text-right text-sm text-muted-foreground">
                    {{ __('form.common.remember_your_password') }}
                    <a href="{{ route('login') }}"
                        class="hover:underline">{{ __('form.login.submit') }}</a>
                </p>
            </div>

        </div>
    </div>
@endsection
