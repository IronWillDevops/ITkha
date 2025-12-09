@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/category.title') }} | {{ $category->title }}
@endsection

@section('admin.content')
    <div class="flex items-center gap-4 mb-4">
        <x-admin.form.action-button type='link' route="{{ route('admin.category.edit', $category->id) }}" icon="fas fa-edit"
            label="{{ __('admin/common.buttons.edit') }}" />
        <x-admin.form.action-button type='form' method="DELETE" route="{{ route('admin.category.delete', $category->id) }}"
            icon="fas fa-trash-alt" label="{{ __('admin/common.buttons.delete') }}" />
    </div>

    {{-- Метаданные --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
        <div>
            <span class="font-medium">{{ __('admin/common.fields.title') }}:</span>
            {{ $category->title }}
        </div>
        <div>
            <span class="font-medium">{{ __('admin/common.fields.created_at') }}:</span>
            {{ $category->created_at }}
        </div>
    </div>

    {{-- Связанные посты --}}
    <div class="border-t border-border pt-4">
        <h2 class="text-lg font-semibold mb-2">
            {{ __('admin/common.fields.post') }}
        </h2>

        <x-admin.form.table :columns="$columns" :items="$posts" modelRoute="post" :sortField="$sortField" :sortDirection="$sortDirection"
            searchEnabled="true" />
    </div>
@endsection
