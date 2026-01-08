@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/log.title') }}
@endsection
@section('admin.content')
      <x-form.table 
        :columns="$columns"
        :items="$logsactivity"
        modelRoute="ActivityLog"
        :sortField="$sortField"
        :sortDirection="$sortDirection"
        searchEnabled="true"
        :showView="false"
        :showEdit="false"
        :showDelete="false"
    />
@endsection
