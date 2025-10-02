@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="text-card-foreground bg-card max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">

        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold mb-2">{{ __('public/login.title') }}</h2>
                <span class="text-sm text-muted-foreground">{{ __('public/login.description') }}</span>
            </div>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                {{-- Email --}}
                <x-public.form.input type="email" name="email" label="{{ __('public/common.fields.email') }}"
                    placeholder="{{ __('public/common.placeholder.email') }}" icon="fas fa-solid fa-at" />

                {{-- Password --}}
                <x-public.form.password name="password" label="{{ __('public/common.fields.password') }}"
                    placeholder="{{ __('public/common.placeholder.password') }}" icon="fas fa-solid fa-lock" />

                @error('error')
                    <p class="text-error ">{{ $message }}</p>
                @enderror

                <div class="mb-4 flex justify-between">
                    <x-public.form.check-box name="remember" label="{{ __('public/login.remember_me') }}" />
                    <a href="{{ route('public.auth.forgot.password.index') }}"
                        class="text-sm text-muted-foreground hover:underline">{{ __('public/login.links.forgot_password') }}

                    </a>
                </div>

                {{-- Submit --}}
                <x-public.form.submit label="{{ __('public/login.title') }}" class="w-full" />
            </form>

            <p class="mt-4 text-right text-sm text-muted-foreground">
                {{ __('public/login.links.dont_have_account') }}
                <a href="{{ route('public.auth.register.index') }}"
                    class="hover:underline">{{ __('public/login.links.register_now') }}</a>
            </p>
        </div>
    </div>
@endsection
