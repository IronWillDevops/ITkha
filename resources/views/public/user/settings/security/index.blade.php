@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- Sidebar (тільки власник) --}}
        <div class="lg:col-span-1">
            @include('components.public.user.sidebar', ['user' => $user])
        </div>
        <div class="lg:col-span-3 space-y-6 ">
            <form action="{{ route('public.user.settings.security.update', $user) }}" method="POST"
                enctype="multipart/form-data" class="space-y-10 bg-card rounded-xl border border-border shadow-lg p-6">
                @csrf
                @method('PATCH')

                <section class="security">
                    <h2 class="text-xl font-semibold text-primary mb-4">{{ __('public/user.sections.security') }}</h2>
                    <x-form.password name="current_password" label="{{ __('public/common.fields.password_current') }}"
                        placeholder="{{ __('public/common.placeholder.password_current') }}" />
                    <x-form.password name="password" label="{{ __('public/common.fields.password') }}"
                        placeholder="{{ __('public/common.placeholder.password') }}" />
                    <x-form.password name="password_confirmation"
                        label="{{ __('public/common.fields.password_confirmation') }}"
                        placeholder="{{ __('public/common.placeholder.password_confirmation') }}" />
                </section>

                <div class="text-right inline-block">
                    <x-form.submit label="{{ __('public/user.buttons.submit') }}" />
                </div>
            </form>
        </div>

    </div>
@endsection
