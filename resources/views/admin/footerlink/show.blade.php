@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/footerlink.title') }} | {{ $link->title }}
@endsection

@section('admin.content')
    
        <div class="flex items-center gap-4 mb-4">
            <x-admin.form.action-button type='link' route="{{ route('admin.footerlink.edit', $link->id) }}"
                icon="fas fa-edit" label="{{ __('admin/footerlink.actions.edit') }}" />
            <x-admin.form.action-button type='form' method="DELETE"
                route="{{ route('admin.footerlink.delete', $link->id) }}" icon="fas fa-trash-alt"
                label="{{ __('admin/footerlink.actions.delete') }}" />

            
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
                    class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">{{ $link->url }}</a>
            </div>
            <div>
                <span class="font-medium">{{ __('admin/footerlink.fields.created_at') }}:</span>
                {{ $link->created_at }}
            </div>

        </div>

@endsection
