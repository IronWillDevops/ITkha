@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/category.title') }}
@endsection
@section('admin.content')
    <div class="flex items-center justify-between mb-6">
        <x-form.table-actions type='link' route="{{ route('admin.category.create') }}" icon="fa-solid fa-plus"
            label="{{ __('admin/common.buttons.create') }}" />

    </div>

    {{-- Таблица категорий --}}
    <x-form.table
        :columns="$columns"
        :items="$categories"
        modelRoute="category"
        :sortField="$sortField"
        :sortDirection="$sortDirection"
        searchEnabled="true"
        :showView="false"
    />

@endsection
