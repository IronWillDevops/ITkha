@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/settings/policy.title') }}
@endsection


@section('admin.content')
    <div class="flex items-center justify-between mb-6">
        <x-form.table-actions type='link' route="{{ route('admin.setting.policy.create') }}" icon="fa-solid fa-plus"
            label="{{ __('admin/common.buttons.create') }}" />


    </div>

    <x-form.table :columns="$columns" :items="$policies" modelRoute="setting.policy" :sortField="$sortField" :sortDirection="$sortDirection"
        searchEnabled="true" :showView="false" :showDelete="false"/>

@endsection