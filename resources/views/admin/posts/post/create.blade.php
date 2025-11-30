    @extends('admin.layouts.app')
    @section('admin.content.title')
        {{ __('admin/post.title') }}
    @endsection

    @section('admin.content')
        {{-- Форма --}}
        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

                
            <x-admin.form.input name="title" label="{{ __('admin/common.fields.title') }}"
                placeholder="{{ __('admin/common.placeholder.title') }}" icon="fa-solid fa-heading" />

            {{-- Изображение --}}
            <x-admin.form.file-input name="main_image" label="{{ __('admin/post.fields.main_image') }}" />

            {{-- Категория --}}
            <x-admin.form.select name="category_id" label="{{ __('admin/common.fields.category') }}" :options="$categories"
                value-field="id" label-field="title" />

            {{-- Теги --}}
            <x-admin.form.checkboxes name="tag_ids" label="{{ __('admin/common.fields.tag') }}" :options="$tags"
                value-field="id" label-field="title" />

            {{-- Editor --}}
            <x-admin.form.editor name="content" label="{{ __('admin/post.fields.content') }}"
                placeholder="{{ __('admin/post.placeholder.content') }}" />

            {{-- Статус --}}
            <x-admin.form.select name="status" label="{{ __('admin/common.fields.status') }}" :options="$status"
                value-field="value" label-field="value" />

            {{-- Автор --}}
            <x-admin.form.select name="user_id" label="{{ __('admin/common.fields.author') }}" :options="$users"
                value-field="id" label-field="email" value="{{ Auth::user()->id }}" />

            {{-- Разрешить комментарии --}}
            <x-admin.form.checkbox name="comments_enabled" label="{{ __('admin/post.fields.comment_enabled') }}"
                value="1" :checked="$commentsEnabled" />


            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.buttons.create') }}" />
                <x-admin.form.button href="{{ route('admin.post.index') }}"
                    label="{{ __('admin/common.buttons.cancel') }}" />
            </div>
        </form>
    @endsection
