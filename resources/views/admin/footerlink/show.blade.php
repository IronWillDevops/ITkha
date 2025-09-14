@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/footerlink.title') }} | {{ $link->title }}
@endsection

@section('admin.content')
    <div class="mx-auto p-4 bg-surface border border-border rounded-lg text-text-primary">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.footerlink.edit', $link->id) }}"
                class="px-4 py-2 border border-border rounded-xl shadow transition">
                <i class="fas fa-edit"></i> {{ __('admin/footerlink.actions.edit') }}
            </a>

            <form action="{{ route('admin.footerlink.delete', $link->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 border border-border rounded-xl shadow transition text-text-danger"
                    onclick="return confirm('{{ __('admin/common.messages.confirm_delete') }}')">
                    <i class="fas fa-trash-alt"></i> {{ __('admin/footerlink.actions.delete') }}
                </button>
            </form>
        </div>

        {{-- Метаданные --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
            <div>
                <span class="font-medium">{{ __('admin/footerlink.fields.icon') }}:</span>
                <i class="fab {{ $link->icon }}"></i>
            </div>
            <div>
                <span class="font-medium">{{ __('admin/footerlink.fields.title') }}:</span>
                {{ $link->title }}
            </div>
            <div>
                <span class="font-medium">{{ __('admin/footerlink.fields.url') }}:</span>
                <a href="{{ $link->url }}" target="_blank"
                    class="link link-hover hover:underline">{{ $link->url }}</a>
            </div>
            <div>
                <span class="font-medium">{{ __('admin/footerlink.fields.created_at') }}:</span>
                {{ $link->created_at }}
            </div>

        </div>

    </div>
@endsection
