    @extends('admin.layouts.app')
    @section('admin.content.title')
        {{ __('admin/categories.actions.edit') }}
    @endsection

    @section('admin.content')
        {{-- Форма --}}
        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <x-admin.form.input name="title" label="{{ __('admin/categories.fields.title') }}" value="{{ $category->title }}"
                placeholder="{{ __('admin/categories.placeholder.title') }}" icon="fa-solid fa-heading" />

            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.actions.edit') }}" />
                <x-admin.form.button href="{{ route('admin.category.index') }}"
                    label="{{ __('admin/common.actions.cancel') }}" />
            </div>
        </form>
    @endsection
