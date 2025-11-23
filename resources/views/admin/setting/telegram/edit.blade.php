@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/settings.telegram.title') }}
@endsection

@section('admin.content')
    <form method="POST" action="{{ route('admin.setting.telegram.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Разрешить комментарии под постами --}}
        <x-admin.form.checkbox name="telegram_enabled" label="{{ __('admin/settings.telegram.enabled') }}"
            :checked="$telegramEnabled" />

        {{-- Telegram Token --}}
        <x-public.form.password name="telegram_token" label="{{ __('admin/settings.telegram.token') }}"
            placeholder="{{ __('admin/settings.telegram.placeholder.token') }}" :required='false' />

        {{-- Telegram ChatID --}}
        <x-public.form.password name="telegram_chatid" label="{{ __('admin/settings.telegram.chatid') }}"
            placeholder="{{ __('admin/settings.telegram.placeholder.chatid') }}" :required='false' />

        <x-admin.form.checkbox name="telegram_send_without_sound"
            label="{{ __('admin/settings.telegram.send_without_sound') }}" :checked="$telegramSendWithoutSound" />
        @php
            $placeholder =
                "<b>{{ title }}</b>\n\nCategory: {{ category }}\nTags: {{ tags }}\n\n{{ excerpt }}";
        @endphp

        <x-admin.form.area name="telegram_template" label="Шаблон сообщения" :placeholder="$placeholder" :value="$telegramTemplate"/>

        <div class="flex space-x-3">

            <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
            <x-admin.form.button href="{{ route('admin.setting.comment.edit') }}"
                label="{{ __('admin/common.actions.cancel') }}" />

        </div>
    </form>
@endsection
