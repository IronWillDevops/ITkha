@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold mb-2">{{ __('public/contact.title') }}</h2>
            <span class="text-sm text-muted-foreground">{{ __('public/contact.description') }}</span>
        </div>

        <form class="max-w-md mx-auto" action="{{ route('public.pages.contact.store') }}" method="POST">
            @csrf
            {{-- Name --}}
            <x-form.input name="name" label="{{ __('public/common.fields.first_name') }}"
                placeholder="{{ __('public/common.placeholder.first_name') }}" icon="fas fa-solid fa-user" />

            {{-- Email --}}
            <x-form.input type="email" name="email" label="{{ __('public/common.fields.email') }}"
                placeholder="{{ __('public/common.placeholder.email') }}" icon="fas fa-solid fa-at" />

            {{-- Subject --}}
            <x-form.input name="subject" label="{{ __('public/contact.fields.subject') }}"
                placeholder="{{ __('public/contact.placeholder.subject') }}" icon="fas fa-envelope" />

            {{-- Message --}}
            <x-form.area name="message" label="{{ __('public/contact.fields.message') }}"
                placeholder="{{ __('public/contact.placeholder.message') }}" />

            {{-- Captcha --}}
            <x-public.form.captcha name="captcha" label="{{ __('public/common.fields.captcha') }}"
                placeholder="{{ __('public/common.placeholder.captcha') }}" />


            <x-form.submit label="{{ __('public/contact.buttons.submit') }}" class="w-full" />
    </div>
@endsection
