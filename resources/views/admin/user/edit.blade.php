@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/users.actions.edit') }}
@endsection

@section('admin.content')
    <div class="mx-auto p-6  bg-surface border border-border rounded-lg text-text-primary">
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PATCH')
            {{-- Personal Information --}}
            <details class="group" open>
                <summary class="cursor-pointer mb-4">
                    <span class="text-xl font-semibold ">{{ __('admin/profile.sections.personal') }}</span>
                </summary>
                <section>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Avatar --}}
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
                                <x-admin.form.file-input name="avatar" label="{{ __('admin/users.fields.avatar') }}" />
                            </div>
                        </div>
                        <div class="flex items-center gap-6 mb-6">
                            <div class="flex-1">
                                <x-admin.form.input name="login" label="{{ __('admin/users.fields.login') }}"
                                    value="{{ $user->login }}" placeholder="{{ __('admin/users.placeholder.login') }}"
                                    icon="fas fa-solid fa-user" />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <x-admin.form.input name="name" label="{{ __('admin/users.fields.name') }}"
                            value="{{ $user->name }}" placeholder="{{ __('admin/users.placeholder.name') }}"
                            icon="fas fa-solid fa-user" />

                        {{-- SurName --}}
                        <x-admin.form.input name="surname" label="{{ __('admin/users.fields.surname') }}"
                            value="{{ $user->surname }}" placeholder="{{ __('admin/users.placeholder.surname') }}"
                            icon="fas fa-solid fa-user" :required="false" />
                    </div>

                    {{-- Email --}}
                    <x-admin.form.input type="email" name="email" label="{{ __('admin/users.fields.email') }}"
                        value="{{ $user->email }}" placeholder="{{ __('admin/users.placeholder.email') }}"
                        icon="fas fa-solid fa-at" />
                </section>
            </details>
            
            {{-- Professional Information --}}
            <details class="group" open>
                <summary class="cursor-pointer mb-4">
                    <span class="text-xl font-semibold ">{{ __('admin/profile.sections.job') }}</span>
                </summary>
                <section>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Job Title --}}
                        <x-admin.form.input name="job_title" label="{{ __('admin/profile.fields.job_title') }}"
                            value="{{ $user->profile?->job_title }}" icon="fas fa-solid fa-user placeholder="{{ __('admin/users.placeholder.job_title') }}"":required="false" />
                        {{-- Address --}}
                        <x-admin.form.input name="address" label="{{ __('admin/profile.fields.address') }}"
                            value="{{ $user->profile?->address }}" icon="fas fa-solid fa-user" placeholder="{{ __('admin/users.placeholder.address') }}" :required="false" />
                    </div>
                    {{-- Website --}}
                    <x-admin.form.input type="website" name="website" label="Website"
                        value="{{ $user->profile?->website }}" icon="fas fa-link" placeholder="{{ __('admin/users.placeholder.website') }}" :required="false" />

                    {{-- About me --}}
                    <x-admin.form.area name="about_myself" label="{{ __('admin/profile.fields.about_myself') }}"
                        placeholder="{{ __('admin/profile.fields.about_myself') }}"
                        value="{{ $user->profile?->about_myself }}" placeholder="{{ __('admin/users.placeholder.about_myself') }}" :required="false" />
                </section>
            </details>
            
            {{-- Social Networks --}}
            <details class="group">
                <summary class="cursor-pointer mb-4">
                    <span class="text-xl font-semibold ">{{ __('admin/profile.sections.social') }}</span>
                </summary>
                <section>
                    {{-- Git Hub --}}
                    <x-admin.form.input type="website" name="github" label="Git Hub" value="{{ $user->profile?->github }}"
                        icon="fab fa-github" placeholder="{{ __('admin/users.placeholder.github') }}" :required="false" />
                    {{-- LinkedIn --}}
                    <x-admin.form.input type="website" name="linkedin" label="LinkedIn"
                        value="{{ $user->profile?->linkedin }}" icon="fab fa-linkedin" placeholder="{{ __('admin/users.placeholder.linkedin') }}" :required="false" />
                </section>
            </details>
            
            {{-- Setting --}}
            <details class="group">
                <summary class="cursor-pointer mb-4">
                    <span class="text-xl font-semibold ">{{ __('admin/profile.sections.setting') }}</span>
                </summary>
                <section>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Role --}}
                        <x-admin.form.select name="role_id" label="{{ __('admin/users.fields.role') }}" :options="$roles"
                            value-field="id" label-field="title" :value="$user->roles()->first()->id" />
                        {{-- Статус --}}
                        <x-admin.form.select name="status" label="{{ __('admin/users.fields.status') }}" :options="$status"
                            value-field="value" label-field="value" :value="$user->status" />
                        {{-- Is Verify --}}
                        <x-admin.form.checkbox name="email_verified_at" label="{{ __('admin/users.fields.verified') }}"
                            :checked="$user->email_verified_at" />
                    </div>
                </section>
            </details>
            
            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
                <x-admin.form.button href="{{ route('admin.user.index') }}"
                    label="{{ __('admin/common.actions.cancel') }}" />
            </div>
        </form>
    </div>
@endsection
