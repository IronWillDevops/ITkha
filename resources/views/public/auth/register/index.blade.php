@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>

            <form method="POST" action="{{ route('public.auth.register.store') }}">
                @csrf
                {{-- Name --}}
                <x-public.form.input.text type="text" name="name" text="{{ __('form.common.name') }}"
                    placeholder="{{ __('form.common.name') }}" icon="fas fa-solid fa-user" />
                {{-- SurName --}}
                <x-public.form.input.text type="text" name="surname" text="{{ __('form.common.surname') }}"
                    placeholder="{{ __('form.common.surname') }}" icon="fas fa-solid fa-user" />
                {{-- Login --}}
                <x-public.form.input.text type="text" name="login" text="{{ __('form.common.login') }}"
                    placeholder="{{ __('form.common.login') }}" icon="fas fa-solid fa-user" />
                {{-- Email --}}
                <x-public.form.input.text type="email" name="email" text="{{ __('form.common.email') }}"
                    placeholder="{{ __('form.common.email') }}" icon="fas fa-solid fa-at" />

                {{-- Password --}}
                <x-public.form.input.password name="password" text="{{ __('form.common.password') }}"
                    placeholder="{{ __('form.common.password') }}" :showStrengthBar="true" />
                {{-- Password --}}
                <x-public.form.input.password name="password_confirmation" text="{{ __('form.common.password_repeat') }}"
                    placeholder="{{ __('form.common.password_repeat') }}" />

                {{-- Captcha --}}
                <x-public.form.input.captcha name="captcha" />
                {{-- Submit --}}
                <x-public.form.input.submit text="{{ __('form.register.submit') }}" />
            </form>

            <p class="mt-4 text-right text-sm text-text-secondary">
                {{ __('form.common.already_have_an_account') }}
                <a href="{{ route('login') }}" class="link link-hover hover:underline">{{ __('form.login.submit') }}</a>
            </p>
        </div>
    </div>
@endsection

