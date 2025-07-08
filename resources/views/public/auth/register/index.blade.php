@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>

            <form method="POST" action="{{ route('public.auth.register.store') }}">
                @csrf
                {{-- Name --}}
                <x-public.form.input.text type="text" name="name" text="Your name" placeholder="Your name"
                    icon="fas fa-solid fa-user" />
                {{-- SurName --}}
                <x-public.form.input.text type="text" name="surname" text="Your surname" placeholder="Your surname"
                    icon="fas fa-solid fa-user" />
                {{-- Login --}}
                <x-public.form.input.text type="text" name="login" text="Your login" placeholder="Your login"
                    icon="fas fa-solid fa-user" />
                {{-- Email --}}
                <x-public.form.input.text type="email" name="email" text="Your email" placeholder="Your email"
                    icon="fas fa-solid fa-at" />

                {{-- Password --}}
                <x-public.form.input.password name="password" text="Your password" placeholder="Your password"
                    icon="fas fa-solid fa-lock" />
                {{-- Password --}}
                <x-public.form.input.password name="password_confirmation" text="Confirmation password"
                    placeholder="Repeat password" icon="fas fa-solid fa-lock" />

                {{-- Captcha --}}
                <x-public.form.input.captcha name="captcha" text="Captcha" placeholder="Enter Captcha" />

                {{-- Submit --}}
                <x-public.form.input.submit text="Register"/>
            </form>

            <p class="mt-4 text-right text-sm text-text-secondary">
                Already have an account?
                <a href="{{ route('login') }}" class="link link-hover hover:underline">Login</a>
            </p>
        </div>
    </div>
@endsection
@push('scripts')
    @vite('resources/js/public/togglePasswordVisibility.js')
@endpush
