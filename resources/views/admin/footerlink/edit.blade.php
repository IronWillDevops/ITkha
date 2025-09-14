@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/footerlink.actions.edit') }}
@endsection

@section('admin.content')
    <div class="mx-auto p-6 bg-surface border border-border rounded-lg text-text-primary shadow-sm">
        {{-- Форма --}}
        <form action="{{ route('admin.footerlink.update',$link->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Имя --}}
                <x-admin.form.input name="icon" label="{{ __('admin/footerlink.fields.icon') }}"
                    placeholder="{{ __('admin/footerlink.placeholder.icon') }}" icon="fas fa-solid fa-icons" value="{{ $link->icon }}"/>

                {{-- Фамилия --}}
                <x-admin.form.input name="title" label="{{ __('admin/footerlink.fields.title') }}"
                    placeholder="{{ __('admin/footerlink.placeholder.title') }}" icon="fas fa-solid fa-heading" value="{{ $link->title }}"/>
            </div>
            <x-admin.form.input name="url" label="{{ __('admin/footerlink.fields.url') }}"
                placeholder="{{ __('admin/footerlink.placeholder.url') }}" icon="fas fa-solid fa-link" value="{{ $link->url }}"/>
            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
                <x-admin.form.button href="{{ route('admin.footerlink.index') }}"
                    label="{{ __('admin/common.actions.cancel') }}" />
            </div>
        </form>
    </div>
@endsection
