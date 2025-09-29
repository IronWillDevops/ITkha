@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="text-card-foreground bg-card max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">

        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                {{-- Email --}}
                <x-public.form.input type="email" name="email" label="{{ __('form.common.email') }}"
                    placeholder="{{ __('form.common.email') }}" icon="fas fa-solid fa-at" />

                {{-- Password --}}
                <x-public.form.password name="password" label="{{ __('form.common.password') }}"
                    placeholder="{{ __('form.common.password') }}" icon="fas fa-solid fa-lock" />

                @error('error')
                    <p class="text-error ">{{ $message }}</p>
                @enderror

                <div class="mb-4 flex justify-between">
                    <x-public.form.check-box name="remember" label="{{ __('form.common.remember') }}" />
                    <a href="{{ route('public.auth.forgot.password.index') }}"
                        class="text-sm text-muted-foreground hover:underline">{{ __('form.common.forgot_password') }}

                    </a>
                </div>

                {{-- Submit --}}
                <x-public.form.submit label="{{ __('form.login.submit') }}" class="w-full"/>
            </form>

            <p class="mt-4 text-right text-sm text-muted-foreground">
                {{ __('form.common.dont_have_account') }}
                <a href="{{ route('public.auth.register.index') }}"
                    class="hover:underline">{{ __('form.common.register_now') }}</a>
            </p>
        </div>
    </div>
@endsection
