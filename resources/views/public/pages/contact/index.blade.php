@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <h2 class="text-2xl font-semibold text-center mb-6">Contact Us</h2>
        <form class="max-w-md mx-auto" action="{{ route('public.pages.contact.store') }}" method="POST">
            @csrf

            {{-- Name --}}
            <x-public.form.input.text type="text" name="name" text="Your name" placeholder="Your name"
                icon="fas fa-solid fa-user" />

            {{-- Email --}}
            <x-public.form.input.text type="email" name="email" text="Your email" placeholder="Your email"
                icon="fas fa-solid fa-at" />

            {{-- Subject --}}
            <x-public.form.input.text type="text" name="subject" text="Your subject" placeholder="Your subject"
                icon="fas fa-envelope" />
            
                {{-- Message --}}
            <x-public.form.input.area name="message" text="Your message" placeholder="Your message" />



            {{-- Captcha --}}
            <x-public.form.input.captcha name="captcha" text="Captcha" placeholder="Enter Captcha" />


            <button type="submit"
                class="input-btn input-btn-hover font-medium  text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Send</button>
        </form>

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
