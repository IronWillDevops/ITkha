@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/users.actions.create') }}
@endsection

@section('admin.content')
    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Основная информация --}}


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Аватар --}}
            <x-admin.form.file-input name="avatar" label="{{ __('admin/users.fields.avatar') }}" />

            {{-- Имя --}}
            <x-admin.form.input name="name" label="{{ __('admin/users.fields.name') }}"
                placeholder="{{ __('admin/users.placeholder.name') }}" icon="fas fa-solid fa-user" />

            {{-- Фамилия --}}
            <x-admin.form.input name="surname" label="{{ __('admin/users.fields.surname') }}"
                placeholder="{{ __('admin/users.placeholder.surname') }}" icon="fas fa-solid fa-user" />

            {{-- Логин --}}
            <x-admin.form.input name="login" label="{{ __('admin/users.fields.login') }}"
                placeholder="{{ __('admin/users.placeholder.login') }}" icon="fas fa-solid fa-user" />


            {{-- Email --}}
            <x-admin.form.input type="email" name="email" label="{{ __('admin/users.fields.email') }}"
                placeholder="{{ __('admin/users.placeholder.email') }}" icon="fas fa-solid fa-at" />


            {{-- Пароль --}}
            <x-admin.form.input type="password" name="password" label="{{ __('admin/users.fields.password') }}"
                icon="fas fa-solid fa-lock" placeholder="{{ __('admin/users.placeholder.password') }}" />

            {{-- Role --}}
            <x-admin.form.select name="role_id" label="{{ __('admin/users.fields.role') }}" :options="$roles"
                value-field="id" label-field="title" />

            {{-- Статус --}}
            <x-admin.form.select name="status" label="{{ __('admin/users.fields.status') }}" :options="$status"
                value-field="value" label-field="value" />

            {{-- Is Verify --}}
            <x-admin.form.checkbox name="email_verified_at" label="{{ __('admin/users.fields.verified') }}" />

        </div>

        {{-- Кнопки --}}
        <div class="flex space-x-3">
            <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
            <x-admin.form.button href="{{ route('admin.user.index') }}" label="{{ __('admin/common.actions.cancel') }}" />
        </div>
    </form>
@endsection
