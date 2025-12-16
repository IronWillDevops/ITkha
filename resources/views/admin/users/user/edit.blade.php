@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/user.title') }}
@endsection

@section('admin.content')
    <form action="{{ route('admin.user.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')
        {{-- Personal Information --}}
        <details class="group" open>
            <summary class="cursor-pointer mb-4 focus:ring focus:outline-none focus-visible:ring-ring">
                <span class="text-xl font-semibold ">{{ __('admin/user.sections.personal') }}</span>
            </summary>
            <section>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Avatar --}}
                    <div class="flex items-center gap-6 mb-6">
                        <div id="avatarContainer" class="w-24 h-24 rounded-full overflow-hidden border border-border">
                            {{-- Аватар --}}
                            @if ($user->avatar)
                                <img type="button" data-dropdown-toggle="userDropdown"
                                    data-dropdown-placement="bottom-start"
                                    class="relative inline-flex items-center justify-center w-24 h-24 object-cover rounded-full border border-border"
                                    src="{{ asset('storage/' . $user->avatar) }}" data-filename="image.png"
                                    alt="{{ $user->first_name }}">
                            @else
                                <div
                                    class="relative inline-flex items-center justify-center w-24 h-24 overflow-hidden rounded-full border border-border  text-5xl">
                                    <span class="font-bold">
                                        {{ $user->getInitial() }}
                                    </span>
                                </div>
                            @endif

                        </div>

                        <div class="flex-1">
                            <x-form.file name="avatar" label="{{ __('admin/common.fields.avatar') }}" :required="false"/>
                        </div>
                    </div>
                    <div class="flex items-center gap-6 mb-6">
                        <div class="flex-1">
                            <x-form.input name="login" label="{{ __('admin/user.fields.login') }}"
                                value="{{ $user->login }}" placeholder="{{ __('admin/user.placeholder.login') }}"
                                icon="fas fa-solid fa-user" />
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- First name --}}
                    <x-form.input name="first_name" label="{{ __('admin/common.fields.first_name') }}"
                        value="{{ $user->first_name }}" placeholder="{{ __('admin/common.placeholder.first_name') }}"
                        icon="fas fa-solid fa-user" />

                    {{-- Last name --}}
                    <x-form.input name="last_name" label="{{ __('admin/common.fields.last_name') }}"
                        value="{{ $user->last_name }}" placeholder="{{ __('admin/common.placeholder.last_name') }}"
                        icon="fas fa-solid fa-user" :required="false" />
                </div>

                {{-- Email --}}
                <x-form.input type="email" name="email" label="{{ __('admin/common.fields.email') }}"
                    value="{{ $user->email }}" placeholder="{{ __('admin/common.placeholder.email') }}"
                    icon="fas fa-solid fa-at" />
            </section>
        </details>

        {{-- Professional Information --}}
        <details class="group" open>
            <summary class="cursor-pointer mb-4 focus:ring focus:outline-none focus-visible:ring-ring">
                <span class="text-xl font-semibold ">{{ __('admin/user.sections.job') }}</span>
            </summary>
            <section>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Job Title --}}
                    <x-form.input name="job_title" label="{{ __('admin/user.fields.job_title') }}"
                        value="{{ $user->profile?->job_title }}" icon="fas fa-solid fa-user"
                        placeholder="{{ __('admin/user.placeholder.job_title') }}" :required="false" />
                    {{-- Address --}}
                    <x-form.input name="address" label="{{ __('admin/user.fields.address') }}"
                        value="{{ $user->profile?->address }}" icon="fas fa-solid fa-user"
                        placeholder="{{ __('admin/user.placeholder.address') }}" :required="false" />
                </div>
                {{-- Website --}}
                <x-form.input type="website" name="website" label="{{ __('admin/user.fields.website') }}"
                    value="{{ $user->profile?->website }}" icon="fas fa-link"
                    placeholder="{{ __('admin/user.placeholder.website') }}" :required="false" />

                {{-- About me --}}
                <x-form.area name="about_myself" label="{{ __('admin/user.fields.about_myself') }}"
                    value="{{ $user->profile?->about_myself }}"
                    placeholder="{{ __('admin/user.placeholder.about_myself') }}" :required="false" />
            </section>
        </details>

        {{-- Social Media --}}
        <details class="group">
            <summary class="cursor-pointer mb-4 focus:ring focus:outline-none focus-visible:ring-ring ">
                <span class="text-xl font-semibold ">{{ __('admin/user.sections.social') }}</span>
            </summary>
            <section>
                {{-- Git Hub --}}
                <x-form.input type="website" name="github" label="{{ __('admin/user.fields.github') }}"
                    value="{{ $user->profile?->github }}" icon="fab fa-github"
                    placeholder="{{ __('admin/user.placeholder.github') }}" :required="false" />
                {{-- LinkedIn --}}
                <x-form.input type="website" name="linkedin" label="{{ __('admin/user.fields.linkedin') }}"
                    value="{{ $user->profile?->linkedin }}" icon="fab fa-linkedin"
                    placeholder="{{ __('admin/user.placeholder.linkedin') }}" :required="false" />
            </section>
        </details>

        {{-- Setting --}}
        <details class="group">
            <summary class="cursor-pointer mb-4 focus:ring focus:outline-none focus-visible:ring-ring">
                <span class="text-xl font-semibold ">{{ __('admin/user.sections.setting') }}</span>
            </summary>
            <section>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Role --}}
                    <x-form.select name="role_id" label="{{ __('admin/common.fields.role') }}" :options="$roles"
                        value-field="id" label-field="title" :value="$user->roles()->first()->id" />
                    {{-- Статус --}}
                    <x-form.select name="status" label="{{ __('admin/common.fields.status') }}" :options="$status"
                        value-field="value" label-field="value" :value="$user->status" />
                    {{-- Is Verify --}}
                    <x-form.check-box name="email_verified_at" label="{{ __('admin/user.fields.verified') }}"
                        :checked="$user->email_verified_at" />
                </div>
            </section>
        </details>

        {{-- Кнопки --}}
        <div class="flex space-x-3">
            <x-form.submit label="{{ __('admin/common.buttons.edit') }}" />
            <x-form.button href="{{ route('admin.user.index') }}"
                label="{{ __('admin/common.buttons.cancel') }}" />
        </div>
    </form>
@endsection
