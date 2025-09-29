    @extends('admin.layouts.app')
    @section('admin.content.title')
        {{ __('admin/posts.actions.create') }}
    @endsection

    @section('admin.content')
        {{-- Форма --}}
        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <x-admin.form.input name="title" label="{{ __('admin/posts.fields.title') }}"
                placeholder="{{ __('admin/posts.placeholder.title') }}" icon="fa-solid fa-heading" />

            {{-- Изображение --}}
            <x-admin.form.file-input name="main_image" label="{{ __('admin/posts.fields.main_image') }}" />

            {{-- Категория --}}
            <x-admin.form.select name="category_id" label="{{ __('admin/posts.fields.categories') }}" :options="$categories"
                value-field="id" label-field="title" />

            {{-- Теги --}}
            <x-admin.form.checkboxes name="tag_ids" label="{{ __('admin/posts.fields.tags') }}" :options="$tags"
                value-field="id" label-field="title" />

            {{-- Editor --}}
            <x-admin.form.editor name="content" label="{{ __('admin/posts.fields.content') }}"
                placeholder="{{ __('admin/posts.placeholder.content') }}" />

            {{-- Статус --}}
            <x-admin.form.select name="status" label="{{ __('admin/posts.fields.status') }}" :options="$status"
                value-field="value" label-field="value" />

            {{-- Автор --}}
            <x-admin.form.select name="user_id" label="{{ __('admin/posts.fields.author') }}" :options="$users"
                value-field="id" label-field="name" />

            {{-- Разрешить комментарии --}}
            <x-admin.form.checkbox name="comments_enabled" label="{{ __('admin/posts.fields.comments_enabled') }}"
                value="1" :checked="old('comments_enabled', true)" />

            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
                <x-admin.form.button href="{{ route('admin.post.index') }}"
                    label="{{ __('admin/common.actions.cancel') }}" />
            </div>
        </form>
    @endsection
