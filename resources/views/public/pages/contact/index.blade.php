@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold mb-2">{{ __('public/contact_us.title') }}</h2>
            <span class="text-sm text-muted-foreground">{{ __('public/contact_us.description') }}</span>
        </div>

        <form class="max-w-md mx-auto" action="{{ route('public.pages.contact.store') }}" method="POST">
            @csrf
            {{-- Name --}}
            <x-public.form.input name="name" label="{{ __('public/common.fields.name') }}"
                placeholder="{{ __('public/common.placeholder.name') }}" icon="fas fa-solid fa-user" />

            {{-- Email --}}
            <x-public.form.input type="email" name="email" label="{{ __('public/common.fields.email') }}"
                placeholder="{{ __('public/common.placeholder.email') }}" icon="fas fa-solid fa-at" />

            {{-- Subject --}}
            <x-public.form.input name="subject" label="{{ __('public/common.fields.subject') }}"
                placeholder="{{ __('public/common.placeholder.subject') }}" icon="fas fa-envelope" />

            {{-- Message --}}
            <x-public.form.area name="message" label="{{ __('public/common.fields.message') }}"
                placeholder="{{ __('public/common.placeholder.message') }}" />

            {{-- Captcha --}}
            <x-public.form.captcha name="captcha" label="{{ __('public/common.fields.captcha') }}"
                placeholder="{{ __('public/common.placeholder.captcha') }}" />


            <x-public.form.submit label="{{ __('public/contact_us.submit') }}" class="w-full"/>
    </div>
@endsection
