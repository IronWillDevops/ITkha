@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/user.title') }}
@endsection

@section('admin.content')
    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Основная информация --}}


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Аватар --}}
            <x-admin.form.file-input name="avatar" label="{{ __('admin/common.fields.avatar') }}" />

            {{-- Имя --}}
            <x-admin.form.input name="name" label="{{ __('admin/common.fields.name') }}"
                placeholder="{{ __('admin/common.placeholder.name') }}" icon="fas fa-solid fa-user" />

            {{-- Фамилия --}}
            <x-admin.form.input name="surname" label="{{ __('admin/common.fields.surname') }}"
                placeholder="{{ __('admin/common.placeholder.surname') }}" icon="fas fa-solid fa-user" />

            {{-- Логин --}}
            <x-admin.form.input name="login" label="{{ __('admin/user.fields.login') }}"
                placeholder="{{ __('admin/user.placeholder.login') }}" icon="fas fa-solid fa-user" />


            {{-- Email --}}
            <x-admin.form.input type="email" name="email" label="{{ __('admin/common.fields.email') }}"
                placeholder="{{ __('admin/common.placeholder.email') }}" icon="fas fa-solid fa-at" />


            {{-- Пароль --}}
            <x-admin.form.input type="password" name="password" label="{{ __('admin/user.fields.password') }}"
                icon="fas fa-solid fa-lock" placeholder="{{ __('admin/user.placeholder.password') }}" />

            {{-- Role --}}
            <x-admin.form.select name="role_id" label="{{ __('admin/common.fields.role') }}" :options="$roles"
                value-field="id" label-field="title" :value="$user_default_role"/>

            {{-- Статус --}}
            <x-admin.form.select name="status" label="{{ __('admin/common.fields.status') }}" :options="$status"
                value-field="value" label-field="value" :value="$user_default_status"/>

            {{-- Is Verify --}}
            <x-admin.form.checkbox name="email_verified_at" label="{{ __('admin/user.fields.verified') }}" :checked="$user_require_email_verification"/>

        </div>

        {{-- Кнопки --}}
        <div class="flex space-x-3">
            <x-admin.form.submit label="{{ __('admin/common.buttons.create') }}" />
            <x-admin.form.button href="{{ route('admin.user.index') }}" label="{{ __('admin/common.buttons.cancel') }}" />
        </div>
    </form>
@endsection
