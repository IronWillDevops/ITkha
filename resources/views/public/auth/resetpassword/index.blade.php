@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="text-card-foreground bg-card max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">

        <div class="w-full max-w-md p-8 rounded-2xl">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold mb-2">{{ __('public/auth/reset.title') }}</h2>
                <span class="text-sm text-muted-foreground">{{ __('public/auth/reset.description') }}</span>
            </div>
            <form method="POST" action="{{ route('public.auth.reset.password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                {{-- Password --}}
                <x-public.form.password name="password" label="{{ __('public/common.fields.password') }}"
                    placeholder="{{ __('public/common.placeholder.password') }}" />
                {{-- Password --}}
                <x-public.form.password name="password_confirmation"
                    label="{{ __('public/common.fields.password_confirmation') }}"
                    placeholder="{{ __('public/common.placeholder.password_confirmation') }}" />

                {{-- Submit --}}
                <x-public.form.submit label="{{ __('public/auth/reset.buttons.submit') }}" class="w-full" />


            </form>
            <div class="mb-4">
                <p class="mt-4  text-right text-sm text-muted-foreground">
                    {{ __('public/common.links.remember_your_password') }}
                    <a href="{{ route('login') }}" class="hover:underline">{{ __('public/common.links.login') }}</a>
                </p>
            </div>

        </div>
    </div>
@endsection
