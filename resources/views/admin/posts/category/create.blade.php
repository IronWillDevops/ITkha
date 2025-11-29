    @extends('admin.layouts.app')

    @section('admin.content.title')
        {{ __('admin/categories.actions.create') }}
    @endsection

    @section('admin.content')
        {{-- Форма --}}
        <form action="{{ route('admin.category.store') }}" method="POST" class="space-y-6">
            @csrf
            <x-admin.form.input name="title" label="{{ __('admin/categories.fields.title') }}"
                placeholder="{{ __('admin/categories.placeholder.title') }}" icon="fa-solid fa-heading" />

            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
                <x-admin.form.button href="{{ route('admin.category.index') }}"
                    label="{{ __('admin/common.actions.cancel') }}" />
            </div>
        </form>
    @endsection
