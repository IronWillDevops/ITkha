    @extends('admin.layouts.app')
    @section('admin.content.title')
        {{ __('admin/posts.actions.edit') }}
    @endsection

    @section('admin.content')
        {{-- Форма --}}
        <form action="{{ route('admin.post.update', $post) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PATCH')

            <x-admin.form.input name="title" label="{{ __('admin/posts.fields.title') }}" value="{{ $post->title }}"
                placeholder="{{ __('admin/posts.placeholder.title') }}" icon="fa-solid fa-heading" />

            {{-- Изображение --}}
            <x-admin.form.file-input name="main_image" label="{{ __('admin/posts.fields.main_image') }}" />

            {{-- Категория --}}
            <x-admin.form.select name="category_id" label="{{ __('admin/posts.fields.categories') }}" :options="$categories"
                value-field="id" label-field="title" value="{{ $post->category_id }}" />

            {{-- Теги --}}
            <x-admin.form.checkboxes name="tag_ids" label="{{ __('admin/posts.fields.tags') }}" :options="$tags"
                value-field="id" label-field="title" :selected="$post->tags->pluck('id')->toArray()" />

            {{-- Editor --}}
            <x-admin.form.editor name="content" label="{{ __('admin/posts.fields.content') }}"
                placeholder="{{ __('admin/posts.placeholder.content') }}" value="{{ $post->content }}" />

            {{-- Статус --}}
            <x-admin.form.select name="status" label="{{ __('admin/posts.fields.status') }}" :options="$status"
                value-field="value" label-field="value" :value="$post->status" />

            {{-- Автор --}}
            <x-admin.form.select name="user_id" label="{{ __('admin/posts.fields.author') }}" :options="$users"
                value-field="id" label-field="email" value="{{ $post->user_id }}" />

            {{-- Разрешить комментарии --}}
            <x-admin.form.checkbox name="comments_enabled" label="{{ __('admin/posts.fields.comments_enabled') }}"
                :checked="$post->comments_enabled" />

            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
                <x-admin.form.button href="{{ route('admin.post.index') }}"
                    label="{{ __('admin/common.actions.cancel') }}" />
            </div>
        </form>
    @endsection
