@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>

            <form method="POST" action="{{ route('public.auth.register.store') }}">
                @csrf

                {{-- Name --}}

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium" for="name">Your name</label>
                    <div class="relative mb-2">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fas fa-solid  fa-user"></i>
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
                    <label class="block mb-2 text-sm font-medium" for="surname">Your surname</label>
                    <div class="relative mb-2">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fas fa-solid fa-user"></i>
                        </div>
                        <input type="text" name="surname" id="surname" value="{{ old('surname') }}"
                            class="input input-hover text-sm  block w-full ps-10 p-2.5 " placeholder="Your surname"
                            required />

                    </div>
                    @error('surname')
                        <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium" for="login">Your login</label>
                    <div class="relative mb-2">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fas fa-solid fa-user"></i>
                        </div>
                        <input type="text" name="login" id="login" value="{{ old('login') }}"
                            class="input input-hover text-sm  block w-full ps-10 p-2.5 " placeholder="Your login"
                            required />

                    </div>
                    @error('login')
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
                            class="input input-hover text-sm  block w-full ps-10 p-2.5 " placeholder="Your email"
                            required />

                    </div>
                    @error('email')
                        <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium" for="password">Your password</label>
                    <div class="relative mb-2">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fas fa-solid fa-lock"></i>
                        </div>
                        <input type="password" name="password" id="password" value="{{ old('password') }}"
                            class="input input-hover text-sm  block w-full ps-10 p-2.5 " placeholder="Your password"
                            required />
                        <button type="button" onclick="togglePasswordVisibility('password', this)"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2  hover:text-text-hover focus:outline-none">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium" for="password_confirmation">Confirmation password</label>
                    <div class="relative mb-2">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fas fa-solid fa-lock"></i>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            value="{{ old('password_confirmation') }}"
                            class="input input-hover text-sm  block w-full ps-10 p-2.5 " placeholder="Confirmation password"
                            required />
                        <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2  hover:text-text-hover focus:outline-none">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium"  for="captcha">Captcha</label>
                    <div class="relative mb-2">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i class="fas fa-key"></i>
                        </div>
                        <input type="text" name="captcha"  id="captcha" class="input input-hover text-sm  block w-full ps-10 p-2.5 "
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

                {{-- Submit --}}
                <button type="submit" class="w-full input-btn input-btn-hover py-2 px-4 rounded-lg transition">
                    Register
                </button>
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
