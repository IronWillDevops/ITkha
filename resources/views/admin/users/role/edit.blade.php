@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/role.title') }}
@endsection

@section('admin.content')
    <form action="{{ route('admin.role.update', $role) }}" method="POST">
        @csrf
        @method('PATCH')
        {{-- Название роли --}}
        <x-form.input name="title" label="{{ __('admin/common.fields.title') }}" icon="fa-solid fa-user-plus"
            value="{{ $role->title }}" />
        <x-form.input name="description" label="{{ __('admin/common.fields.description') }}"
            placeholder="{{ __('admin/common.placeholder.description') }}" icon="fa fa-info-circle"  value="{{ $role->description }}" />
        {{-- Permissions --}}
        <div class="mb-6">
            <h2 class="font-semibold mb-2">{{ __('admin/permission.title') }}</h2>

            @foreach ($permissions as $header => $group)
                <details class="group">
                    <summary class="cursor-pointer mb-4">
                        <span class="text-xl font-semibold">{{ __('admin/permission.' . $header . '.label') }}</span>
                    </summary>
                    <section>
                        @foreach ($group as $permission)
                            <x-form.check-box name="permissions[]" label="{{ __('admin/permission.' . $permission->key) }}"
                                value="{{ $permission->id }}"
                                checked="{{ $role->permissions->contains($permission->id) ? true : false }}" />
                        @endforeach
                    </section>
                </details>
            @endforeach
        </div>

        {{-- Кнопки --}}
        <div class="flex space-x-3">
            <x-form.submit label="{{ __('admin/common.buttons.edit') }}" />
            <x-form.button href="{{ route('admin.role.index') }}" label="{{ __('admin/common.buttons.cancel') }}" />
        </div>
    </form>
@endsection
