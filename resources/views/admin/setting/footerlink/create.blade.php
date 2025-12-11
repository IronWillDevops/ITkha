@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/settings/footerlink.title') }}
@endsection

@section('admin.content')
  
        {{-- Форма --}}
        <form action="{{ route('admin.setting.footerlink.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Имя --}}
                <x-form.input name="icon" label="{{ __('admin/common.fields.icon') }}"
                    placeholder="{{ __('admin/common.placeholder.icon') }}" icon="fas fa-solid fa-icons" />

                {{-- Фамилия --}}
                <x-form.input name="title" label="{{ __('admin/common.fields.title') }}"
                    placeholder="{{ __('admin/common.placeholder.title') }}" icon="fas fa-solid fa-heading" />
            </div>
            <x-form.input name="url" label="{{ __('admin/common.fields.url') }}"
                placeholder="{{ __('admin/common.placeholder.url') }}" icon="fas fa-solid fa-link" />
            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-form.submit label="{{ __('admin/common.buttons.save') }}" />
                <x-form.button href="{{ route('admin.setting.footerlink.index') }}"
                    label="{{ __('admin/common.buttons.cancel') }}" />
            </div>
        </form>
@endsection
