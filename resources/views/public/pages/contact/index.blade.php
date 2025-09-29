@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <h2 class="text-2xl font-semibold text-center mb-6">Contact Us</h2>
        <form class="max-w-md mx-auto" action="{{ route('public.pages.contact.store') }}" method="POST">
            @csrf
            {{-- Name --}}
            <x-public.form.input name="name" label="{{ __('form.common.name') }}"
                placeholder="{{ __('form.common.name') }}" icon="fas fa-solid fa-user" />

            {{-- Email --}}
            <x-public.form.input type="email" name="email" label="{{ __('form.common.email') }}"
                placeholder="{{ __('form.common.email') }}" icon="fas fa-solid fa-at" />

            {{-- Subject --}}
            <x-public.form.input name="subject" label="{{ __('form.contact_us.subject') }}" placeholder="{{ __('form.contact_us.subject') }}"
                icon="fas fa-envelope" />

            {{-- Message --}}
            <x-public.form.area name="message" label="{{ __('form.contact_us.message') }}" placeholder="{{ __('form.contact_us.message') }}" />

            {{-- Captcha --}}
            <x-public.form.captcha name="captcha" label="{{ __('form.common.captcha') }}"
                placeholder="{{ __('form.common.captcha') }}" />


            <x-public.form.submit label="{{ __('form.contact_us.submit') }}" />
    </div>
@endsection
