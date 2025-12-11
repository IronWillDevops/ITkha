    @extends('admin.layouts.app')
    @section('admin.content.title')
        {{ __('admin/comment.title') }}
    @endsection

    @section('admin.content')
        {{-- Форма --}}
        
        <form action="{{ route('admin.comment.update', $comment->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <x-form.area name="body" label="{{ __('admin/comment.fields.body') }}"
                placeholder="{{ __('admin/comment.placeholder.body') }}" value="{{ $comment->body }}" />

            <x-admin.form.select name="status" label="{{ __('admin/common.fields.status') }}" :options="$status"
                value-field="value" label-field="value" :value="$comment->status->value" />
            {{-- Автор --}}
            <x-admin.form.select name="user_id" label="{{ __('admin/common.fields.author') }}" :options="$users"
                value-field="id" label-field="name" value="{{ $comment->user_id }}" />
            {{-- Кнопки --}}

            <div class="flex space-x-3">
                <x-form.submit label="{{ __('admin/common.buttons.edit') }}" />
                <x-admin.form.button href="{{ route('admin.comment.index') }}"
                    label="{{ __('admin/common.buttons.cancel') }}" />
            </div>
        </form>
    @endsection
