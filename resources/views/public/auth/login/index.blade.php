@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">

        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium">Your email</label>
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



                {{-- Пароль --}}

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium">Your password</label>
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
                    @error('error')
                        <p class="text-error ">{{ $message }}</p>
                    @enderror
                </div>



              
                <div class="mb-4 flex items-center justify-between">
                    <label class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" value="" class="w-4 h-4 rounded-sm"
                            {{ old('remember') ? 'checked' : '' }}>
                        <span class="ms-2 text-sm font-medium">Remember me</span>
                    </label>
                    <a href="{{ route('public.auth.forgot.password.index') }}" class="text-sm link link-hover hover:underline">Forgot password?

                    </a>
                </div>

                {{-- Кнопка входа --}}
                <button type="submit"
                    class="input-btn input-btn-hover w-full font-medium  text-sm  px-5 py-2.5 text-center ">Log in</button>
            </form>

            <p class="mt-4 text-right text-sm text-text-secondary">
                Don't have an account?
                <a href="{{ route('public.auth.register.index') }}" class="link link-hover hover:underline">Register now</a>
            </p>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/public/togglePasswordVisibility.js')
@endpush
