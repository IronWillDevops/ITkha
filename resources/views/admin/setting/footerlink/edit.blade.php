@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/settings/footerlink.title') }}
@endsection

@section('admin.content')
  
        {{-- Форма --}}
        <form action="{{ route('admin.setting.footerlink.update',$link->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Имя --}}
               <x-form.input name="icon" label="{{ __('admin/common.fields.icon') }}"
                    placeholder="{{ __('admin/common.placeholder.icon') }}" icon="fas fa-solid fa-icons" value="{{ $link->icon }}"/>

                {{-- Фамилия --}}
               <x-form.input name="title" label="{{ __('admin/common.fields.title') }}"
                    placeholder="{{ __('admin/common.placeholder.title') }}" icon="fas fa-solid fa-heading" value="{{ $link->title }}"/>
            </div>
           <x-form.input name="url" label="{{ __('admin/common.fields.url') }}"
                placeholder="{{ __('admin/common.placeholder.url') }}" icon="fas fa-solid fa-link" value="{{ $link->url }}"/>
            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.buttons.edit') }}" />
                <x-admin.form.button href="{{ route('admin.setting.footerlink.index') }}"
                    label="{{ __('admin/common.buttons.cancel') }}" />
            </div>
        </form>
@endsection
