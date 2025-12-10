@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/settings/general.title') }}
@endsection

@section('admin.content')
    <form method="POST" action="{{ route('admin.setting.site.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')


        <x-form.input name="site_name" label="{{ __('admin/settings/general.fields.name') }}" icon="fa-solid fa-heading"
            placeholder="{{ __('admin/settings/general.placeholder.name') }}" value="{{ $site_name }}" />

        <x-admin.form.area name="site_description" label="{{ __('admin/settings/general.fields.description') }}"
            placeholder="{{ __('admin/settings/general.placeholder.description') }}" value="{{ $site_description }}" />

        <x-form.input name="site_keywords" label="{{ __('admin/settings/general.fields.keywords') }}"
            icon="fa-solid fa-heading" placeholder="{{ __('admin/settings/general.placeholder.keywords') }}"
            value="{{ $site_keywords }}" />


        <x-form.file name="site_favicon" label="Favicon" icon="fa-regular fa-file-image" />




        <div class="flex space-x-3">
            <x-admin.form.submit label="{{ __('admin/common.buttons.save') }}" />
            <x-admin.form.button href="{{ route('admin.setting.site.edit') }}"
                label="{{ __('admin/common.buttons.cancel') }}" />
        </div>
    </form>
@endsection
