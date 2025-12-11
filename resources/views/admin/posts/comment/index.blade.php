@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/comment.title') }}
@endsection
@section('admin.content')
        <x-form.table
        :columns="$columns"
        :items="$comments"
        modelRoute="comment"
        :sortField="$sortField"
        :sortDirection="$sortDirection"
        searchEnabled="true"
        :showView="false"
    />

@endsection
