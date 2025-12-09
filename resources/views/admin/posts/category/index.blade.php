@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/category.title') }}
@endsection
@section('admin.content')
    <div class="flex items-center justify-between mb-6">
        <x-admin.form.action-button type='link' route="{{ route('admin.category.create') }}" icon="fa-solid fa-plus"
            label="{{ __('admin/common.buttons.create') }}" />

    </div>

    {{-- Таблица категорий --}}
    <x-admin.form.table
        :columns="$columns"
        :items="$categories"
        modelRoute="category"
        :sortField="$sortField"
        :sortDirection="$sortDirection"
        searchEnabled="true"
        :showView="false"
    />

@endsection
