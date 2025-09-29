@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="bg-card text-card-foreground max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <div class="w-full max-w-md p-8 bg-card text-card-foreground rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>

            <form method="POST" action="{{ route('public.auth.register.store') }}">
                @csrf
                <x-public.form.input name="name" label="{{ __('form.common.name') }}"
                    placeholder="{{ __('form.common.name') }}" icon="fas fa-solid fa-user" />
                <x-public.form.input name="surname" label="{{ __('form.common.surname') }}"
                    placeholder="{{ __('form.common.surname') }}" icon="fas fa-solid fa-user" />
                {{-- Login --}}
                <x-public.form.input name="login" label="{{ __('form.common.login') }}"
                    placeholder="{{ __('form.common.login') }}" icon="fas fa-solid fa-user" />
                {{-- Email --}}
                <x-public.form.input type="email" name="email" label="{{ __('form.common.email') }}"
                    placeholder="{{ __('form.common.email') }}" icon="fas fa-solid fa-at" />
                {{-- Password --}}
                <x-public.form.password name="password" label="{{ __('form.common.password') }}"
                    placeholder="{{ __('form.common.password') }}" />
                {{-- Password --}}
                <x-public.form.password name="password_confirmation" label="{{ __('form.common.password_repeat') }}"
                    placeholder="{{ __('form.common.password_repeat') }}" />
                {{-- Captcha --}}
                <x-public.form.captcha name="captcha" />
                
                {{-- Submit --}}
                <x-public.form.submit label="{{ __('form.register.submit') }}" />

            </form>

            <p class="mt-4 text-right text-sm text-muted-foreground">
                {{ __('form.common.already_have_an_account') }}
                <a href="{{ route('login') }}" class="hover:underline">{{ __('form.login.submit') }}</a>
            </p>
        </div>
    </div>
@endsection
