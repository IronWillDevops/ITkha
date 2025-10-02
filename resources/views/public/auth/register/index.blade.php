@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="bg-card text-card-foreground max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <div class="w-full max-w-md p-8 bg-card text-card-foreground rounded-2xl">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold mb-2">{{ __('public/register.title') }}</h2>
                <span class="text-sm text-muted-foreground">{{ __('public/register.description') }}</span>
            </div>

            <form method="POST" action="{{ route('public.auth.register.store') }}">
                @csrf
                <x-public.form.input name="name" label="{{ __('public/common.fields.name') }}"
                    placeholder="{{ __('public/common.placeholder.name') }}" icon="fas fa-solid fa-user" />
                <x-public.form.input name="surname" label="{{ __('public/common.fields.surname') }}"
                    placeholder="{{ __('public/common.placeholder.surname') }}" icon="fas fa-solid fa-user" />
                {{-- Login --}}
                <x-public.form.input name="login" label="{{ __('public/common.fields.login') }}"
                    placeholder="{{ __('public/common.placeholder.login') }}" icon="fas fa-solid fa-user" />
                {{-- Email --}}
                <x-public.form.input type="email" name="email" label="{{ __('public/common.fields.email') }}"
                    placeholder="{{ __('public/common.placeholder.email') }}" icon="fas fa-solid fa-at" />
                {{-- Password --}}
                <x-public.form.password name="password" label="{{ __('public/common.fields.password') }}"
                    placeholder="{{ __('public/common.placeholder.password') }}" />
                {{-- Password --}}
                <x-public.form.password name="password_confirmation" label="{{ __('public/common.fields.password_confirmation') }}"
                    placeholder="{{ __('public/common.placeholder.password_confirmation') }}" />
                {{-- Captcha --}}
                <x-public.form.captcha name="captcha" />

                {{-- Submit --}}
                <x-public.form.submit label="{{ __('public/register.submit') }}" class="w-full"/>

            </form>

            <p class="mt-4 text-right text-sm text-muted-foreground">
                {{ __('public/register.links.already_have_an_account') }}
                <a href="{{ route('login') }}" class="hover:underline">{{ __('public/register.links.login') }}</a>
            </p>
        </div>
    </div>
@endsection
