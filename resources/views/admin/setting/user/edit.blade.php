@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/settings.users.title') }}
@endsection

@section('admin.content')
    <form method="POST" action="{{ route('admin.setting.user.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Статус по умолчанию --}}
        <x-admin.form.select name="user_default_status" label="{{ __('admin/settings.users.default_status') }}"
            :options="$status" :value="$user_default_status" value-field="value" label-field="value" />
       
      
        {{-- Роль по умолчанию --}}
        <x-admin.form.select name="user_default_role" label="{{ __('admin/settings.users.default_role') }}"
            :options="$roles" :value="$user_default_role" value-field="id" label-field="title" /> 

        {{-- Требовать подтверждение email --}}
        <x-admin.form.checkbox name="user_require_email_verification"
            label="{{ __('admin/settings.users.require_email_verification') }}" :checked="$user_require_email_verification" />

        <div class="flex space-x-3">
            <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
            <x-admin.form.button href="{{ route('admin.setting.user.edit') }}"
                label="{{ __('admin/common.actions.cancel') }}" />
        </div>
    </form>
@endsection
