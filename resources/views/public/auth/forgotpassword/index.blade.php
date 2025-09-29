@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="bg-card text-card-foreground max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">

        <div class="w-full max-w-md p-8 rounded-2xl">

            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold mb-2">{{ __('public/login.title') }}</h2>
                <span class="text-muted-foreground">{{ __('public/login.description') }}</span>
            </div>

            <form method="POST" action="{{ route('public.auth.forgot.password.store') }}">
                @csrf
                {{-- Email --}}
                <x-public.form.input type="email" name="email" label="{{ __('form.common.email') }}"
                    placeholder="{{ __('form.common.email') }}" icon="fas fa-solid fa-at" />

                {{-- Captcha --}}
                <x-public.form.captcha name="captcha" />

                {{-- Submit --}}
                <x-public.form.submit label="{{ __('form.forgot.submit') }}" />


            </form>
            <div class="mb-4">
                <p class="mt-4 text-right text-sm text-muted-foreground">
                    {{ __('form.common.remember_your_password') }}
                    <a href="{{ route('login') }}" class="hover:underline">{{ __('form.login.submit') }}</a>
                </p>
            </div>
        </div>
    </div>
@endsection
