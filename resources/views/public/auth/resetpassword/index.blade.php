@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">

        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>
            <p>Your new password must be different from previous used passwords.</p>
            <form method="POST" action="{{ route('public.auth.reset.password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

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
                </div>
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium">Confirmation password</label>
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
                {{-- Кнопка входа --}}
                <button type="submit"
                    class="input-btn input-btn-hover w-full font-medium  text-sm  px-5 py-2.5 text-center ">Reset
                    password</button>
            </form>
            <div class="mb-4">
                <p class="mt-4  text-right text-sm text-text-secondary">
                    Remember your password?
                    <a href="{{ route('login') }}" class="link link-hover hover:underline">Log in</a>
                </p>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/public/togglePasswordVisibility.js')
@endpush
