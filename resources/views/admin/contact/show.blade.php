@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/contacts.title') }} | {{ $contact->subject }}
@endsection

@section('admin.content')
    <div class="space-y-6">
        <form action="{{ route('admin.setting.contact.reply', $contact) }}" method="POST" class="space-y-6">
            @csrf

            {{-- Відправник / Отримувач --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-admin.form.input name="from" label="{{ __('admin/contacts.mail.from') }}" icon="fa-solid fa-at"
                    value="{{ config('mail.from.address') }}" readonly />
                <x-admin.form.input name="to" label="{{ __('admin/contacts.mail.to') }}" icon="fa-solid fa-at"
                    value="{{ $contact->email }}" readonly />
            </div>

            {{-- Тема та повідомлення --}}
            <div class="space-y-4">
                <x-admin.form.input name="subject" label="{{ __('admin/contacts.mail.subject') }}"
                    value="Request Ticket#{{ $contact->id }} - {{ $contact->subject }}" icon="fa-solid fa-envelope"
                    readonly />

                <x-admin.form.area name="message" label="{{ __('admin/contacts.mail.message') }}"
                    placeholder="Write your reply here..." rows="6">{{ old('message') }}</x-admin.form.area>

                <div class="rounded-lg p-4 text-sm border">
                    <span class="font-medium">{{ __('admin/contacts.mail.original_message') }}</span>
                    <p class="mt-2 whitespace-pre-line">{{ $contact->message }}</p>
                </div>
            </div>

            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <div class="flex space-x-3">
                    <x-admin.form.submit label="{{ __('admin/common.actions.send') }}" />


                    <x-admin.form.button href="{{ route('admin.post.index') }}"
                        label="{{ __('admin/common.actions.cancel') }}" />
                </div>

            </div>
        </form>

    </div>
@endsection
