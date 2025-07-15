@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <h2 class="text-2xl font-semibold text-center mb-6">Contact Us</h2>
        <form class="max-w-md mx-auto" action="{{ route('public.pages.contact.store') }}" method="POST">
            @csrf

            {{-- Name --}}
            <x-public.form.input.text type="text" name="name" text="{{ __('form.common.name') }}"
                placeholder="{{ __('form.common.name') }}" icon="fas fa-solid fa-user" />

            {{-- Email --}}
            <x-public.form.input.text type="email" name="email" text="{{ __('form.common.email') }}"
                placeholder="{{ __('form.common.email') }}" icon="fas fa-solid fa-at" />

            {{-- Subject --}}
            <x-public.form.input.text type="text" name="subject" text="{{ __('form.contact_us.subject') }}" placeholder="{{ __('form.contact_us.subject') }}"
                icon="fas fa-envelope" />

            {{-- Message --}}
            <x-public.form.input.area name="message" text="{{ __('form.contact_us.message') }}" placeholder="{{ __('form.contact_us.message') }}" />

            {{-- Captcha --}}
            <x-public.form.input.captcha name="captcha" text="{{ __('form.common.captcha') }}"
                placeholder="{{ __('form.common.captcha') }}" />


            <x-public.form.input.submit text="{{ __('form.contact_us.submit') }}" />


    </div>


























    <script>
        function updateCharacterCount(textarea) {
            const maxLength = 1000; // Максимальна кількість символів, яку ви вказали у валідації
            const currentLength = textarea.value.length;
            const countElement = document.getElementById('message-count');
            countElement.textContent = `${currentLength} / ${maxLength}`;

            if (currentLength > maxLength) {
                countElement.classList.remove('text-muted');
                countElement.classList.add('text-danger');
            } else {
                countElement.classList.remove('text-danger');
                countElement.classList.add('text-muted');
            }
        }

        // Ініціалізація лічильника при завантаженні сторінки (для випадку, якщо є попередньо введені дані)
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('message');
            if (textarea) {
                updateCharacterCount(textarea);
            }
        });
    </script>
@endsection
