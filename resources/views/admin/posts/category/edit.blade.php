    @extends('admin.layouts.app')
    @section('admin.content.title')
        {{ __('admin/category.title') }}
    @endsection

    @section('admin.content')
        {{-- Форма --}}
        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <x-form.input name="title" label="{{ __('admin/common.fields.title') }}" value="{{ $category->title }}"
                placeholder="{{ __('admin/common.placeholder.title') }}" icon="fa-solid fa-heading" />

            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-form.submit label="{{ __('admin/common.buttons.edit') }}" />
                <x-admin.form.button href="{{ route('admin.category.index') }}"
                    label="{{ __('admin/common.buttons.cancel') }}" />
            </div>
        </form>
    @endsection
