@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">

        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>

            <form method="POST" action="{{ route('public.auth.forgot.password.store') }}">
                @csrf

                {{-- Email --}}
                <x-public.form.input.text type="email" name="email" text="Your email" placeholder="Your email"
                    icon="fas fa-solid fa-at" />
                {{-- Captcha --}}
                <x-public.form.input.captcha name="captcha" text="Captcha" placeholder="Enter Captcha" />

                {{-- Submit --}}
                <x-public.form.input.submit text="Reset password"/>
                
            </form>
            <div class="mb-4">
                <p class="mt-4  text-right text-sm text-text-secondary">
                    Remember your password?
                    <a href="{{ route('login') }}" class="link link-hover hover:underline">Log in</a>
                </p>
            </div>

        </div>
    </div>
@endsection
