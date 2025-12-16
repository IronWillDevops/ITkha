@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/settings/policy.title') }}
@endsection
@section('admin.content')
    <form action="{{ route('admin.setting.policy.store') }}" method="POST" class="space-y-6">
        @csrf

        <x-form.input name="key" label="{{ __('admin/common.fields.key') }}"
            placeholder="{{ __('admin/common.placeholder.key') }}" icon="fa-solid fa-heading" />
        {{-- Мультиязычные поля --}}

        @foreach ($locales as $locale)
            <fieldset class="border border-border p-4 mb-4 rounded">
                <legend class="font-bold">{{ strtoupper($locale) }}</legend>
                <input type="hidden" name="translations[{{ $loop->index }}][locale]" value="{{ $locale }}"/>

                <x-form.input name="translations[{{ $loop->index }}][title]" label="{{ __('admin/common.fields.title') }}" placeholder="{{ __('admin/common.placeholder.title') }}"
                    icon="fas fa-solid fa-heading" />
                <x-form.editor name="translations[{{ $loop->index }}][content]"
                    label="{{ __('admin/common.fields.content') }}"
                    placeholder="{{ __('admin/common.placeholder.content') }}" />

            </fieldset>
        @endforeach
        <x-form.check-box name="is_active" label="{{ __('admin/common.fields.is_active') }}" />
        {{-- Кнопки --}}
        <div class="flex space-x-3">
            <x-form.submit label="{{ __('admin/common.buttons.save') }}" />
            <x-form.button href="{{ route('admin.setting.policy.index') }}"
                label="{{ __('admin/common.buttons.cancel') }}" />
        </div>
    </form>
@endsection
