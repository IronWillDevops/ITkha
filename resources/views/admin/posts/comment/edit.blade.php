    @extends('admin.layouts.app')
    @section('admin.content.title')
        {{ __('admin/comments.actions.edit') }}
    @endsection

    @section('admin.content')
        {{-- Форма --}}
        
        <form action="{{ route('admin.comment.update', $comment->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <x-admin.form.area name="body" label="{{ __('admin/comments.fields.body') }}"
                placeholder="{{ __('admin/comments.placeholder.body') }}" value="{{ $comment->body }}" />

            <x-admin.form.select name="status" label="{{ __('admin/comments.fields.status') }}" :options="$status"
                value-field="value" label-field="value" :value="$comment->status->value" />
            {{-- Автор --}}
            <x-admin.form.select name="user_id" label="{{ __('admin/posts.fields.author') }}" :options="$users"
                value-field="id" label-field="name" value="{{ $comment->user_id }}" />
            {{-- Кнопки --}}

            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
                <x-admin.form.button href="{{ route('admin.comment.index') }}"
                    label="{{ __('admin/common.actions.cancel') }}" />
            </div>
        </form>
    @endsection
