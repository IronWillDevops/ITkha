@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/footerlink.actions.create') }}
@endsection

@section('admin.content')
  
        {{-- Форма --}}
        <form action="{{ route('admin.footerlink.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Имя --}}
                <x-admin.form.input name="icon" label="{{ __('admin/footerlink.fields.icon') }}"
                    placeholder="{{ __('admin/footerlink.placeholder.icon') }}" icon="fas fa-solid fa-icons" />

                {{-- Фамилия --}}
                <x-admin.form.input name="title" label="{{ __('admin/footerlink.fields.title') }}"
                    placeholder="{{ __('admin/footerlink.placeholder.title') }}" icon="fas fa-solid fa-heading" />
            </div>
            <x-admin.form.input name="url" label="{{ __('admin/footerlink.fields.url') }}"
                placeholder="{{ __('admin/footerlink.placeholder.url') }}" icon="fas fa-solid fa-link" />
            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
                <x-admin.form.button href="{{ route('admin.footerlink.index') }}"
                    label="{{ __('admin/common.actions.cancel') }}" />
            </div>
        </form>
@endsection
