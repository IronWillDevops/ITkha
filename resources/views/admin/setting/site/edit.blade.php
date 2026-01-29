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

        <x-form.area name="site_description" label="{{ __('admin/settings/general.fields.description') }}"
            placeholder="{{ __('admin/settings/general.placeholder.description') }}" value="{{ $site_description }}" />

        <x-form.input name="site_keywords" label="{{ __('admin/settings/general.fields.keywords') }}"
            icon="fa-solid fa-heading" placeholder="{{ __('admin/settings/general.placeholder.keywords') }}"
            value="{{ $site_keywords }}" :required="false"/>

        <x-form.input type="email" name="site_email" label="{{ __('admin/settings/general.fields.site_email') }}"
            icon="fas fa-solid fa-at" placeholder="{{ __('admin/settings/general.placeholder.site_email') }}"
            value="{{ $site_email }}" :required="false" />

        <x-form.input type="tel" name="site_phone" label="{{ __('admin/settings/general.fields.site_phone') }}"
            icon="fa-solid fa-phone" placeholder="{{ __('admin/settings/general.placeholder.site_phone') }}"
            value="{{ $site_phone }}" :required="false"/>

        <x-form.input name="site_address" label="{{ __('admin/settings/general.fields.site_address') }}"
            icon="fa-solid fa-map-location-dot" placeholder="{{ __('admin/settings/general.placeholder.site_address') }}"
            value="{{ $site_address }}"  :required="false" />

        <x-form.file name="site_favicon" label="Favicon" icon="fa-regular fa-file-image" :required="false"/>

        <div class="flex space-x-3">
            <x-form.submit label="{{ __('admin/common.buttons.save') }}" />
            <x-form.button href="{{ route('admin.setting.site.edit') }}"
                label="{{ __('admin/common.buttons.cancel') }}" />
        </div>
    </form>
@endsection
