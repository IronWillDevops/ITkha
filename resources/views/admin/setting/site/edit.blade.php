@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/settings.site.title') }}
@endsection

@section('admin.content')
    <form method="POST" action="{{ route('admin.setting.site.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')


        <x-admin.form.input name="site_name" label="{{ __('admin/settings.site.name') }}" icon="fa-solid fa-heading"
            placeholder="{{ __('admin/settings.site.placeholders.name') }}" value="{{ $site_name }}" />

        <x-admin.form.area name="site_description" label="{{ __('admin/settings.site.description') }}"
            placeholder="{{ __('admin/settings.site.placeholders.description') }}" value="{{ $site_description }}" />

        <x-admin.form.input name="site_keywords" label="{{ __('admin/settings.site.keywords') }}" icon="fa-solid fa-heading"
            placeholder="{{ __('admin/settings.site.placeholders.keywords') }}" value="{{ $site_keywords }}" />

        <x-admin.form.file-input name="site_favicon" label="Favicon" />

        


        <div class="flex space-x-3">
            <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
            <x-admin.form.button href="{{ route('admin.setting.site.edit') }}"
                label="{{ __('admin/common.actions.cancel') }}" />
        </div>
    </form>
@endsection
