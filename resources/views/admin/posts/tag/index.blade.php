@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/tag.title') }}
@endsection
@section('admin.content')
    <div class="flex items-center justify-between mb-6">
        <x-form.table-actions type="link" route="{{ route('admin.tag.create') }}" icon="fa-solid fa-plus"
            label="{{ __('admin/common.buttons.create') }}" variant="primary"/>

    </div>

        {{-- Таблица категорий --}}
    <x-form.table
        :columns="$columns"
        :items="$tags"
        modelRoute="tag"
        :sortField="$sortField"
        :sortDirection="$sortDirection"
        searchEnabled="true"
        :showView="false"
    />
@endsection
