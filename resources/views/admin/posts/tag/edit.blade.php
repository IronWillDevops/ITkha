    @extends('admin.layouts.app')
    @section('admin.content.title')
        {{ __('admin/tags.actions.edit') }}
    @endsection

    @section('admin.content')
        {{-- Форма --}}
        <form action="{{ route('admin.tag.update', $tag->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <x-admin.form.input name="title" label="{{ __('admin/tags.fields.title') }}" value="{{ $tag->title }}"
                placeholder="{{ __('admin/tags.placeholder.title') }}" icon="fa-solid fa-heading" />
            {{-- Кнопки --}}

            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
                <x-admin.form.button href="{{ route('admin.tag.index') }}"
                    label="{{ __('admin/common.actions.cancel') }}" />
            </div>
        </form>
    @endsection
