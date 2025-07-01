@extends('public.layouts.app')

@section('public.content')
    <div class="text-text-primary bg-surface max-w-lg mx-auto mt-10 mb-10 rounded-2xl p-10 border border-border">
        <div class="w-full max-w-md p-8 text-text-primary bg-surface rounded-2xl">
            <h2 class="text-2xl font-bold text-center mb-6">{{ config('app.name') }}</h2>
            <p class=" text-muted mb-6">
                Enter your email to receive the verification link again.
            </p>
            <form method="POST" action="{{ route('public.auth.reverification.store') }}">
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
                            autocomplete="email" autofocus required />

                    </div>
                    @error('email')
                        <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- Submit --}}
                <button type="submit" class="w-full input-btn input-btn-hover py-2 px-4 rounded-lg transition">
                    Resend Verification Email
                </button>
            </form>


        </div>
    </div>
@endsection
