@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/dashboard.title') }}
@endsection
@section('admin.content')
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:lg:grid-cols-4 gap-4">

        <x-admin.dashboard-widget title="{{ __('admin/users.title') }}" icon="fa-solid fa-users"
            description="{{ $userCount }}" link="{{ route('admin.user.index') }}"
            linkText="{{ __('admin/common.actions.read_more') }}" />

        <x-admin.dashboard-widget title="{{ __('admin/posts.title') }}" icon="fa-solid fa-newspaper"
            description="{{ $postCount }}" link="{{ route('admin.post.index') }}"
            linkText="{{ __('admin/common.actions.read_more') }}" />

        <x-admin.dashboard-widget title="{{ __('admin/categories.title') }}" icon="fa-solid fa-tag"
            description="{{ $categoryCount }}" link="{{ route('admin.category.index') }}"
            linkText="{{ __('admin/common.actions.read_more') }}" />

        <x-admin.dashboard-widget title="{{ __('admin/tags.title') }}" icon="fa-solid fa-tags"
            description="{{ $tagCount }}" link="{{ route('admin.tag.index') }}"
            linkText="{{ __('admin/common.actions.read_more') }}" />
            
        <x-admin.dashboard-widget title="{{ __('admin/logs.title') }}" icon="fa-solid fa-history"
            description="{{ $logCount }}" link="{{ route('admin.log.index') }}"
            linkText="{{ __('admin/common.actions.read_more') }}" />

    </div>
@endsection
