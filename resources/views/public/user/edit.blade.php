@extends('public.layouts.user')

@section('public.content')
    <div
        class="text-xl mb-4 p-4 bg-card shadow-sm border border-border text-card-foreground hover:shadow-md rounded-lg">
        <form action="{{ route('public.user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-10">
            @csrf
            @method('PATCH')

            {{-- Розділ: Персональні дані --}}
            <section class="">
                <h2 class="text-xl font-semibold mb-4">{{ __('public/profile.sections.personal') }}</h2>
                <div class="flex items-center gap-6 mb-6">

                    <div id="avatarContainer" class="w-24 h-24 rounded-full overflow-hidden border border-border">
                        @if ($user->avatar)
                            <img type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"
                                class="relative inline-flex items-center justify-center w-24 h-24 object-cover rounded-full border border-border"
                                src="{{ asset('storage/' . $user->avatar) }}" data-filename="image.png"
                                alt="{{ $user->name }}">
                        @else
                            <div
                                class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden rounded-full border border-border">
                                <span class="font-bold text-4xl">
                                    {{ $user->getInitial() }}
                                </span>
                            </div>
                        @endif

                    </div>
                    <div class="flex-1">
                        <span>{{ $user->login }}</span>
                        <x-public.form.input type="file" name="avatar" label="{{ __('public/common.fields.avatar') }}" icon="fas fa-solid fa-user" :required="false" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Name --}}
                    <x-public.form.input name="name" label="{{ __('public/common.fields.name') }}"
                        placeholder="{{ __('public/common.placeholder.name') }}" icon="fas fa-solid fa-user"
                        value="{{ $user->name }}" />
                    {{-- Surname --}}
                    <x-public.form.input name="surname" label="{{ __('public/common.fields.surname') }}"
                        placeholder="{{ __('public/common.placeholder.surname') }}" icon="fas fa-solid fa-user"
                        value="{{ $user->surname }}" />
                </div>
            </section>
            {{-- Розділ: Професійна інформація --}}
            <section class="">
                <h2 class="text-xl font-semibold mb-4">{{ __('public/profile.sections.job_title') }}</h2>
                {{-- Job Title --}}
                <x-public.form.input type="jobtitle" name="job_title" label="{{ __('public/common.fields.job_title') }}"
                    placeholder="{{ __('public/common.placeholder.job_title') }}" icon="fas fa-solid fa-user"
                    value="{{ $user->profile?->job_title }}" :required="false" />

                {{-- Address --}}
                <x-public.form.input type="address" name="address" label="{{ __('public/common.fields.address') }}"
                    placeholder="{{ __('public/common.placeholder.address') }}" icon="fas fa-solid fa-user"
                    value="{{ $user->profile?->address }}" :required="false" />

                {{-- Web site --}}
                <x-public.form.input type="website" name="website" label="{{ __('public/common.fields.website') }}"
                    placeholder="https://example.com" icon="fas fa-link" value="{{ $user->profile?->website }}"
                    :required="false" />

                {{-- About myself --}}
                <x-public.form.area name="about_myself" label="{{ __('public/common.fields.about_myself') }}"
                    placeholder="{{ __('public/common.placeholder.about_myself') }}" value="{{ $user->profile?->about_myself }}"
                    :required="false" />
            </section>
            
            {{-- Розділ: Соціальні мережі --}}
            <section class="">
                <h2 class="text-xl font-semibold mb-4">{{ __('public/profile.sections.social') }}</h2>
                {{-- Web site --}}
                <x-public.form.input type="website" name="github" label="Git Hub" placeholder="https://github.com/"
                    icon="fab fa-github" value="{{ $user->profile?->github }}" :required="false" />
                {{-- LinkeIn --}}

                <x-public.form.input type="website" name="linkedin" label="LinkedIn" placeholder="https://www.linkedin.com/"
                    icon="fab fa-linkedin" value="{{ $user->profile?->linkedin }}" :required="false" />
            </section>

            <div class="text-right inline-block">
                <x-public.form.submit label="{{ __('public/profile.submit') }}" />
            </div>
        </form>

        <x-public.ui.separator />

        <form action="{{ route('public.user.password.update', $user->id) }}" method="POST" class="space-y-10">
            @csrf
            @method('PATCH')
            {{-- Розділ: Безпека --}}
            <section class="">
                <h2 class="text-xl font-semibold mb-4">{{ __('public/profile.sections.security') }}</h2>
                <x-public.form.password name="current_password" label="{{ __('public/common.fields.password_current') }}"
                    placeholder="{{ __('public/common.placeholder.password_current') }}" />
                <x-public.form.password name="password" label="{{ __('public/common.fields.password') }}"
                    placeholder="{{ __('public/common.placeholder.password') }}" />
                <x-public.form.password name="password_confirmation"
                    label="{{ __('public/common.fields.password_confirmation') }}"
                    placeholder="{{ __('public/common.placeholder.password_confirmation') }}" />
            </section>

            <div class="text-right inline-block">
                <x-public.form.submit label="{{ __('public/profile.submit') }}" />
            </div>

        </form>
    </div>
@endsection
