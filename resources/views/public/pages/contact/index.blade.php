@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <h2 class="text-2xl font-semibold text-center mb-6">Contact Us</h2>
        <form class="max-w-md mx-auto" action="{{ route('public.pages.contact.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium" for="name">Your name</label>
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <i class="fas fa-user-alt"></i>
                    </div>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="input input-hover text-sm  block w-full ps-10 p-2.5 " placeholder="Your name" required />

                </div>
                @error('name')
                    <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium" for="email">Your email</label>
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <i class="fas fa-solid fa-at"></i>
                    </div>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="input input-hover text-sm  block w-full ps-10 p-2.5 " placeholder="Your email" required />

                </div>
                @error('email')
                    <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium" for="subject">Your subject</label>
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                        class="input input-hover text-sm  block w-full ps-10 p-2.5 " placeholder="Your subject" required />

                </div>
                @error('subject')
                    <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium" for="message">Your message</label>
                <textarea type="text" name="message" id="message" maxlength="1000" rows="8"
                    class="input input-hover text-sm  block w-full p-2.5 " placeholder="Your message"
                    oninput="updateCharacterCount(this)" required>{{ old('message') }}</textarea>


                @error('message')
                    <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <div id="message-count" class="mt-4 text-xs text-text-secondary text-right">0 / 1000</div>
            </div>
            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium">Captcha</label>
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <i class="fas fa-key"></i>
                    </div>
                    <input type="text" name="captcha" class="input input-hover text-sm  block w-full ps-10 p-2.5 "
                        placeholder="Enter Captcha" required />

                </div>
                <img src="{{ route('captcha.generate') }}" alt="CAPTCHA"
                    onclick="this.src='{{ route('captcha.generate') }}?'+Math.random()" style="cursor:pointer;">
                <small>Click the image to reload the CAPTCHA</small>
                @error('captcha')
                    <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>


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
