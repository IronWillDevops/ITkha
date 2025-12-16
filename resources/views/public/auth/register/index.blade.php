@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div @class([
        'bg-card',
        'text-card-foreground',
        'max-w-lg',
        'mx-auto',
        'mt-10',
        'mb-10',
        'rounded-2xl',
        'p-10',
        'border',
        'border-border',
    ])>
        <div @class([
            'w-full',
            'max-w-md',
            'p-8',
            'bg-card',
            'text-card-foreground',
            'rounded-2xl',
        ])>
            <div @class(['text-center', 'mb-6'])>
                <h2 @class(['text-2xl', 'font-bold', 'mb-2'])>{{ __('public/auth/register.title') }}</h2>
                <span @class(['text-sm', 'text-muted-foreground'])>{{ __('public/auth/register.description') }}</span>
            </div>

            <form method="POST" action="{{ route('public.auth.register.store') }}">
                @csrf
                <x-form.input name="first_name" label="{{ __('public/common.fields.first_name') }}"
                    placeholder="{{ __('public/common.placeholder.first_name') }}" icon="fas fa-solid fa-user" />
                <x-form.input name="last_name" label="{{ __('public/common.fields.last_name') }}"
                    placeholder="{{ __('public/common.placeholder.last_name') }}" icon="fas fa-solid fa-user" />
                {{-- Login --}}
                <x-form.input name="login" label="{{ __('public/common.fields.login') }}"
                    placeholder="{{ __('public/common.placeholder.login') }}" icon="fas fa-solid fa-user" />
                {{-- Email --}}
                <x-form.input type="email" name="email" label="{{ __('public/common.fields.email') }}"
                    placeholder="{{ __('public/common.placeholder.email') }}" icon="fas fa-solid fa-at" />
                {{-- Password --}}
                <x-form.password name="password" label="{{ __('public/common.fields.password') }}"
                    placeholder="{{ __('public/common.placeholder.password') }}" />
                {{-- Password --}}
                <x-form.password name="password_confirmation"
                    label="{{ __('public/common.fields.password_confirmation') }}"
                    placeholder="{{ __('public/common.placeholder.password_confirmation') }}" />
                {{-- Captcha --}}
                <x-form.captcha name="captcha" />
                @php
                    $policyLink =
                        '<a href="' .
                        route('policy.show') .
                        '" class="underline hover:text-primary" target="_blank">' .
                        __('public/common.fields.policy_title') .
                        '</a>';
                @endphp
                <x-form.check-box name="accept_policy" :label="__('public/common.fields.policy_accept', ['link' => $policyLink])" :required="true" />

                {{-- Submit --}}
                <x-form.submit label="{{ __('public/auth/register.buttons.submit') }}" @class(['w-full']) />

            </form>

            <p @class(['mt-4', 'text-right', 'text-sm', 'text-muted-foreground'])>
                {{ __('public/common.links.already_have_an_account') }}
                <a href="{{ route('login') }}" @class(['hover:underline'])>{{ __('public/common.links.login') }}</a>
            </p>
        </div>
    </div>
@endsection
