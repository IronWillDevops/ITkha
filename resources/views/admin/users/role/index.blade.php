@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/role.title') }}
@endsection
@section('admin.content')
    <div class="flex items-center justify-between mb-6">

        <x-form.table-actions type="link" route="{{ route('admin.role.create') }}" icon="fa-solid fa-plus"
            label=" {{ __('admin/common.buttons.create') }}" />

    </div>

   
        <x-form.table :columns="$columns" :items="$roles" modelRoute="role" :sortField="$sortField" :sortDirection="$sortDirection"
            searchEnabled="true" :showView="false"/>
   
@endsection
