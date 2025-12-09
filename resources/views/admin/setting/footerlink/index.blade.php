@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/settings/footerlink.title') }}
@endsection

@section('admin.content')
    <div class="flex items-center justify-between mb-6">
        <x-admin.form.action-button type='link' route="{{ route('admin.setting.footerlink.create') }}" icon="fa-solid fa-plus"
            label="{{ __('admin/common.buttons.create') }}" />


    </div>

     {{-- Таблица FooterLink --}}
    <x-admin.form.table
        :columns="$columns"
        :items="$footerlinks"
        modelRoute="setting.footerlink"
        :sortField="$sortField"
        :sortDirection="$sortDirection"
        searchEnabled="true"
        :showView="false"
    />
@endsection
