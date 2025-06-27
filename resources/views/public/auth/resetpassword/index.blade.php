@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">

        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>

            <form method="POST" action="#">
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

                {{-- Кнопка входа --}}
                <button type="submit"
                    class="input-btn input-btn-hover w-full font-medium  text-sm  px-5 py-2.5 text-center ">Reset
                    password</button>
            </form>
            <div class="mb-4">
                <p class="mt-4  text-right text-sm text-text-secondary">
                    Remember your password?
                    <a href="{{ route('public.auth.login.index') }}" class="link link-hover hover:underline">Log in</a>
                </p>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/public/togglePasswordVisibility.js')
@endpush
