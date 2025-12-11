@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/settings/footerlink.title') }} | {{ $link->title }}
@endsection

@section('admin.content')
    
        <div class="flex items-center gap-4 mb-4">
            <x-form.table-actions type='link' route="{{ route('admin.setting.footerlink.edit', $link->id) }}"
                icon="fas fa-edit" label="{{ __('admin/common.buttons.edit') }}" />
            <x-form.table-actions type='form' method="DELETE"
                route="{{ route('admin.setting.footerlink.delete', $link->id) }}" icon="fas fa-trash-alt"
                label="{{ __('admin/common.buttons.delete') }}" />

            
        </div>

        {{-- Метаданные --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
            <div>
                <span class="font-medium">{{ __('admin/common.fields.icon') }}:</span>
                <i class="fab {{ $link->icon }}"></i>
            </div>
            <div>
                <span class="font-medium">{{ __('admin/common.fields.title') }}:</span>
                {{ $link->title }}
            </div>
            <div>
                <span class="font-medium">{{ __('admin/common.fields.url') }}:</span>
                <a href="{{ $link->url }}" target="_blank"
                    class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">{{ $link->url }}</a>
            </div>
            <div>
                <span class="font-medium">{{ __('admin/common.fields.created_at') }}:</span>
                {{ $link->created_at }}
            </div>

        </div>

@endsection
