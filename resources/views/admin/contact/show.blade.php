@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/contact.title') }} | {{ $contact->subject }}
@endsection

@section('admin.content')
    <div class="space-y-6">
        <form action="{{ route('admin.contact.reply', $contact) }}" method="POST" class="space-y-6">
            @csrf

            {{-- Відправник / Отримувач --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                    
                <x-form.input name="from" label="{{ __('admin/contact.fields.from') }}" icon="fa-solid fa-at"
                    value="{{ config('mail.from.address') }}" readonly />
                <x-form.input name="to" label="{{ __('admin/contact.fields.to') }}" icon="fa-solid fa-at"
                    value="{{ $contact->email }}" readonly />
            </div>

            {{-- Тема та повідомлення --}}
            <div class="space-y-4">
                <x-form.input name="subject" label="{{ __('admin/contact.fields.subject') }}"
                    value="Request Ticket#{{ $contact->id }} - {{ $contact->subject }}" icon="fa-solid fa-envelope"
                    readonly />

                <x-form.area name="message" label="{{ __('admin/contact.fields.message') }}"
                    placeholder="{{ __('admin/contact.placeholder.message') }}" >{{ old('message') }}</x-admin.form.area>

                <div class="rounded-lg p-4 text-sm border">
                    <span class="font-medium">{{ __('admin/contact.fields.original_message') }}</span>
                    <p class="mt-2 whitespace-pre-line">{{ $contact->message }}</p>
                </div>
            </div>

            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <div class="flex space-x-3">
                    <x-admin.form.submit label="{{ __('admin/common.buttons.send') }}" />


                    <x-admin.form.button href="{{ route('admin.post.index') }}"
                        label="{{ __('admin/common.buttons.cancel') }}" />
                </div>

            </div>
        </form>

    </div>
@endsection
