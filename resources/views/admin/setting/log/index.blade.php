@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/log.title') }}
@endsection
@section('admin.content')
      <x-form.table 
        :columns="$columns"
        :items="$logs"
        modelRoute="log"
        :sortField="$sortField"
        :sortDirection="$sortDirection"
        searchEnabled="true"
        :showView="false"
        :showEdit="false"
        :showDelete="false"
    />
@endsection
