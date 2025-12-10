@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/settings/telegram.title') }}
@endsection

@section('admin.content')
    <form method="POST" action="{{ route('admin.setting.telegram.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Разрешить комментарии под постами --}}
        <x-admin.form.checkbox name="telegram_enabled" label="{{ __('admin/settings/telegram.fields.enabled') }}"
            :checked="$telegramEnabled" />

        {{-- Telegram Token --}}
        <x-public.form.password name="telegram_token" label="{{ __('admin/settings/telegram.fields.token') }}"
            placeholder="{{ __('admin/settings/telegram.placeholder.token') }}" :required='false' />

        {{-- Telegram ChatID --}}
        <x-public.form.password name="telegram_chatid" label="{{ __('admin/settings/telegram.fields.chatid') }}"
            placeholder="{{ __('admin/settings/telegram.placeholder.chatid') }}" :required='false' />

        <x-admin.form.checkbox name="telegram_send_without_sound"
            label="{{ __('admin/settings/telegram.fields.send_without_sound') }}" :checked="$telegramSendWithoutSound" />
        @php
            $placeholder =
                "<b>{{ title }}</b>\n\nCategory: {{ category }}\nTags: {{ tags }}\n\n{{ excerpt }}";
        @endphp
        <div class="flex space-x-2 mt-2">
            @php
                $placeholders = [
                    '{{ title }}',
                    '{{ category }}',
                    '{{ tags }}',
                    '{{ author }}',
                    '{{ author_url }}',
                    '{{ data }}',
                    '{{ excerpt }}',
                    '{{ url }}',
                ];
            @endphp
            @foreach ($placeholders as $ph)
                <button type="button" class="text-xs "
                    onclick="insertAtCursor(document.getElementById('telegram_template'), '{{ $ph }}')">
                    <span
                        class="inline-block bg-secondary text-secondary-foreground rounded-full px-3 py-1 cursor-pointer hover:bg-secondary/80">
                        {{ $ph }}
                    </span>
                </button>
            @endforeach
        </div>
        <x-admin.form.area name="telegram_template" label="{{ __('admin/settings/telegram.fields.template') }}"
            :placeholder="$placeholder" :value="$telegramTemplate" />

        <x-form.input name="telegram_message_limit" min="10" max="750" type="number"
            label="{{ __('admin/settings/telegram.fields.message_limit') }}"
            placeholder="{{ __('admin/settings/telegram.placeholder.message_limit') }}" icon="fa-solid fa-heading"
            :value="$telegramMessageLimit" />

        <x-form.input name="telegram_button_text" label="{{ __('admin/settings/telegram.fields.button_text') }}"
            placeholder="{{ __('admin/settings/telegram.placeholder.button_text') }}" icon="fa-solid fa-heading"
            :value="$telegramButtonText" />

        <div class="flex space-x-3">

            <x-admin.form.submit label="{{ __('admin/common.buttons.save') }}" />
            <x-admin.form.button href="{{ route('admin.setting.comment.edit') }}"
                label="{{ __('admin/common.buttons.cancel') }}" />

        </div>
    </form>
@endsection
@push('scripts')
    <script>
        function insertAtCursor(textarea, text) {
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const before = textarea.value.substring(0, start);
            const after = textarea.value.substring(end);
            textarea.value = before + text + after;
            textarea.focus();
            textarea.selectionStart = textarea.selectionEnd = start + text.length;
            updateCharacterCount(textarea); // обновляем счетчик
        }
    </script>
@endpush
