@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/user.title') }}
@endsection

@section('admin.content')
<div class="flex items-center justify-between mb-6">
    <x-form.table-actions 
        type="link" 
        route="{{ route('admin.user.create') }}" 
        icon="fa-solid fa-plus"
        label="{{ __('admin/common.buttons.create') }}" 
    />
</div>

<x-form.table
    :columns="$columns"
    :items="$users"
    modelRoute="user"
    :sortField="$sortField"
    :sortDirection="$sortDirection"
    searchEnabled="true"
/>
@endsection
