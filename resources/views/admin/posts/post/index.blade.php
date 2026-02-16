@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/post.title') }}
@endsection
@section('admin.content')

    <div class="flex items-center justify-between mb-6">
        <x-form.table-actions type='link' route="{{ route('admin.post.create') }}" icon="fa-solid fa-plus"
            label="{{ __('admin/common.buttons.create') }}" variant="primary"/>
    </div>

    <x-form.table  :columns="[
        ['key' => 'id', 'label' => __('admin/common.fields.id')],
        ['key' => 'title', 'label' => __('admin/common.fields.title'), 'wrap' => true],
        ['key' => 'category.title', 'label' => __('admin/common.fields.category')],
        ['key' => 'tags', 'label' => __('admin/common.fields.tag')],
        ['key' => 'status', 'label' => __('admin/common.fields.status')],
        ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
    ]"
    :items="$posts"
    modelRoute="post"
    :sortField="$sortField"
    :sortDirection="$sortDirection"
    searchEnabled="true"/>

@endsection
