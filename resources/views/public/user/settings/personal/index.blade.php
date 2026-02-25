@extends('public.layouts.app-fullwidth')

@section('public.content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- Sidebar (тільки власник) --}}
        <div class="lg:col-span-1">
            @include('components.public.user.sidebar', ['user' => $user])
        </div>
        <div class="lg:col-span-3 space-y-6 ">
            <form action="{{ route('public.user.settings.personal.update',$user) }}" method="POST" enctype="multipart/form-data"
                class="space-y-10 bg-card rounded-xl border border-border shadow-lg p-6">
                @csrf
                @method('PATCH')

                {{-- Розділ: Персональні дані --}}
                <section class="personal">
                    <h2 class="text-lg font-semibold text-primary mb-4">{{ __('public/user.sections.personal') }}</h2>
                    <div class="flex items-center gap-6 mb-6">

                        {{-- Avatar --}}
                        <div class="mb-4 flex justify-center">
                            @if ($user->singleMedia('avatar'))
                                <img class="w-32 h-32 object-cover rounded-full border-4 border-primary"
                                    src="{{ $user->singleMedia('avatar')->url }}" alt="{{ $user->first_name }}">
                            @else
                                <div
                                    class="w-32 h-32 flex items-center justify-center rounded-full border-4 border-primary text-4xl font-bold">
                                    {{ $user->getInitial() }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <span>{{ $user->login }}</span>
                            <x-form.file name="avatar" label="{{ __('public/common.fields.avatar') }}" :required="false" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- First name --}}
                        <x-form.input name="first_name" label="{{ __('public/common.fields.first_name') }}"
                            placeholder="{{ __('public/common.placeholder.first_name') }}" icon="fas fa-solid fa-user"
                            value="{{ $user->first_name }}" />
                        {{-- Last name --}}
                        <x-form.input name="last_name" label="{{ __('public/common.fields.last_name') }}"
                            placeholder="{{ __('public/common.placeholder.last_name') }}" icon="fas fa-solid fa-user"
                            value="{{ $user->last_name }}" />
                    </div>
                </section>
                {{-- Розділ: Професійна інформація --}}
                <section class="">
                    <h2 class="text-xl font-semibold mb-4">{{ __('public/user.sections.job_title') }}</h2>
                    {{-- Job Title --}}
                    <x-form.input type="jobtitle" name="job_title" label="{{ __('public/common.fields.job_title') }}"
                        placeholder="{{ __('public/common.placeholder.job_title') }}" icon="fas fa-solid fa-user"
                        value="{{ $user->profile?->job_title }}" :required="false" />

                    {{-- Address --}}
                    <x-form.input type="address" name="address" label="{{ __('public/common.fields.address') }}"
                        placeholder="{{ __('public/common.placeholder.address') }}" icon="fas fa-solid fa-user"
                        value="{{ $user->profile?->address }}" :required="false" />

                    {{-- Web site --}}
                    <x-form.input type="website" name="website" label="{{ __('public/common.fields.website') }}"
                        placeholder="{{ __('public/common.placeholder.website') }}" icon="fas fa-link"
                        value="{{ $user->profile?->website }}" :required="false" />

                    {{-- About myself --}}
                    <x-form.area name="about_myself" label="{{ __('public/common.fields.about_myself') }}"
                        placeholder="{{ __('public/common.placeholder.about_myself') }}"
                        value="{{ $user->profile?->about_myself }}" :required="false" />
                </section>

                {{-- Розділ: Соціальні мережі --}}
                <section class="">
                    <h2 class="text-xl font-semibold mb-4">{{ __('public/user.sections.social') }}</h2>
                    {{-- Web site --}}
                    <x-form.input type="website" name="github" label="{{ __('public/common.fields.github') }}"
                        placeholder="{{ __('public/common.placeholder.github') }}" icon="fab fa-github"
                        value="{{ $user->profile?->github }}" :required="false" />
                    {{-- LinkeIn --}}

                    <x-form.input type="website" name="linkedin" label="{{ __('public/common.fields.linkedin') }}"
                        placeholder="{{ __('public/common.placeholder.linkedin') }}" icon="fab fa-linkedin"
                        value="{{ $user->profile?->linkedin }}" :required="false" />
                </section>

                <div class="text-right inline-block">
                    <x-form.submit label="{{ __('public/user.buttons.submit') }}" />
                </div>
            </form>
        </div>

    </div>
@endsection
