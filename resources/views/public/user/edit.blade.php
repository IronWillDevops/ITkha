@extends('public.layouts.user')

@section('public.content')
    <div
        class="text-xl font-semibold mb-4 p-4 bg-surface shadow-sm border border-border text-text-primary hover:shadow-md rounded-lg">
        <form action="{{ route('public.user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-10">
            @csrf
            @method('PATCH')

            {{-- Розділ: Персональні дані --}}
            <section class="">
                <h2 class="text-xl font-semibold mb-4">{{ __('profile.sections.personal') }}</h2>
                <div class="flex items-center gap-6 mb-6">

                    <div id="avatarContainer" class="w-24 h-24 rounded-full overflow-hidden border border-border">
                        @if ($user->avatar)
                            <img id="avatarPreview"
                                class="relative inline-flex items-center justify-center h-full w-full object-cover rounded-full border border-border"
                                src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                        @else
                            <div id="avatarInitials"
                                class="w-full h-full flex items-center justify-center bg-muted text-xl font-semibold">
                                {{ $user->getInitial() }}</div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <span>{{ $user->login }}</span>
                        <label for="avatar" class="block font-medium mb-1">{{ __('profile.common.avatar') }}</label>
                        <input type="file" name="avatar" id="avatar"
                            class="w-full text-sm border  rounded-lg px-3 py-2">
                        @error('avatar')
                            <div class=" mb-2 text-sm text-error rounded-lg" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Name --}}
                    <x-public.form.input.text type="text" name="name" text="{{ __('form.common.name') }}"
                        placeholder="{{ __('profile.placeholder.name') }}" icon="fas fa-solid fa-user"
                        value="{{ $user->name }}" />
                    {{-- SurName --}}
                    <x-public.form.input.text type="text" name="surname" text="{{ __('form.common.surname') }}"
                        placeholder="{{ __('profile.placeholder.surname') }}" icon="fas fa-solid fa-user"
                        value="{{ $user->surname }}" />
                </div>
            </section>
            {{-- Розділ: Професійна інформація --}}
            <section class="">
                <h2 class="text-xl font-semibold mb-4">{{ __('profile.sections.job') }}</h2>
                {{-- Job Title --}}
                <x-public.form.input.text type="jobtitle" name="job_title" text="{{ __('profile.job.title') }}"
                    placeholder="{{ __('profile.placeholder.job_title') }}" icon="fas fa-solid fa-user"
                    value="{{ $user->profile?->job_title }}" required="false" />
                {{-- Address --}}
                <x-public.form.input.text type="address" name="address" text="{{ __('profile.common.address') }}"
                    placeholder="{{ __('profile.placeholder.address') }}" icon="fas fa-solid fa-user"
                    value="{{ $user->profile?->address }}" required="false" />
                {{-- Web site --}}
                <x-public.form.input.text type="website" name="website" text="{{ __('profile.job.website') }}"
                    placeholder="https://example.com" icon="fas fa-link" value="{{ $user->profile?->website }}"
                    required="false" />
                {{-- About myself --}}
                <x-public.form.input.area name="about_myself" text="{{ __('profile.job.about') }}"
                    placeholder="{{ __('profile.placeholder.about_myself') }}" value="{{ $user->profile?->about_myself }}"
                    required="false" />
            </section>
            {{-- Social Medіa --}}
            <section class="">
                <h2 class="text-xl font-semibold mb-4">{{ __('profile.sections.social') }}</h2>
                {{-- Web site --}}
                <x-public.form.input.text type="website" name="github" text="Git Hub" placeholder="https://github.com/"
                    icon="fab fa-github" value="{{ $user->profile?->github }}" required="false" />
                <x-public.form.input.text type="website" name="linkedin" text="LinkedIn"
                    placeholder="https://www.linkedin.com/" icon="fab fa-linkedin" value="{{ $user->profile?->linkedin }}"
                    required="false" />
            </section>

            <div class="text-right inline-block">
                <x-public.form.input.submit text="{{ __('profile.common.submit') }}" />
            </div>
        </form>

        <x-public.ui.separator />

        <form action="{{ route('public.user.password.update', $user->id) }}" method="POST" class="space-y-10">
            @csrf
            @method('PATCH')
            {{-- Розділ: Безпека --}}
            <section class="">
                <h2 class="text-xl font-semibold mb-4">{{ __('profile.sections.security') }}</h2>
                <x-public.form.input.password name="current_password" text="{{ __('profile.security.current_password') }}"
                    placeholder="{{ __('profile.placeholder.current_password') }}" />
                <x-public.form.input.password name="password" text="{{ __('profile.security.password_new') }}"
                    placeholder="{{ __('profile.placeholder.password_new') }}" :showStrengthBar="true" />
                <x-public.form.input.password name="password_confirmation"
                    text="{{ __('profile.security.password_confirmation') }}"
                    placeholder="{{ __('profile.placeholder.password_confirmation') }}" />
            </section>

            <div class="text-right inline-block">
                <x-public.form.input.submit text="{{ __('profile.common.submit') }}" />
            </div>

        </form>
    </div>
@endsection

