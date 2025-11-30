@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/settings/comment.title') }}
@endsection

@section('admin.content')
    <form method="POST" action="{{ route('admin.setting.comment.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Разрешить комментарии под постами --}}
        <x-admin.form.checkbox name="comments_enabled" label="{{ __('admin/settings/comment.fields.enabled') }}"
            :checked="$commentsEnabled" />

        {{-- Автоматическое одобрение --}}
        <x-admin.form.checkbox name="comments_auto_approve" label="{{ __('admin/settings/comment.fields.approve') }}"
            :checked="$autoApprove" />

        {{-- Запрещённые слова --}}
        <x-admin.form.area name="comments_filter_words" label="{{ __('admin/settings/comment.fields.filter_words') }}"
            placeholder="{{ __('admin/settings/comment.placeholder.filter_words') }}" :value="$filterWords" minCharactersLenght="0"
            maxCharactersLenght="65000" rows="4" />

        {{-- Политика по ссылкам --}}
        <x-admin.form.select name="comments_links_policy" label="{{ __('admin/settings/comment.fields.links_policy') }}"
            :options="[
                ['value' => 'allow', 'label' => __('admin/settings/comment.fields.links_allow')],
                ['value' => 'remove', 'label' => __('admin/settings/comment.fields.links_remove')],
                ['value' => 'reject', 'label' => __('admin/settings/comment.fields.links_reject')],
            ]" value-field="value" label-field="label" value="{{ $linksPolicy }}" />

        <div class="flex space-x-3">

            <x-admin.form.submit label="{{ __('admin/common.buttons.save') }}" />
            <x-admin.form.button href="{{ route('admin.setting.comment.edit') }}"
                label="{{ __('admin/common.buttons.cancel') }}" />
        </div>
    </form>
@endsection
