@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/contact.title') }}
@endsection

@section('admin.content')

    <x-form.table  
        :columns="$columns"
        :items="$items"
        modelRoute="contact"
        :sortField="$sortField"
        :sortDirection="$sortDirection"
        searchEnabled="true"
        :showView="false"
        :showEdit="false"
        :showDelete="false"
    />
   
@endsection
