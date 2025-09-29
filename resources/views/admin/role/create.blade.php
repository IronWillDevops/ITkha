@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/roles.actions.create') }}
@endsection

@section('admin.content')
        <form action="{{ route('admin.role.store') }}" method="POST">
            @csrf

            {{-- Название роли --}}
            <x-admin.form.input name="title" label="{{ __('admin/roles.fields.title') }}" icon="fa-solid fa-user-plus" />

            {{-- Permissions --}}
            <div class="mb-6">
                <h2 class="font-semibold mb-2">{{ __('admin/permissions.title') }}</h2>

                @foreach ($permissions as $header => $group)
                    <details class="group">
                        <summary class="cursor-pointer mb-4">
                            <span class="text-xl font-semibold">{{ $header }}</span>
                        </summary>
                        <section >
                            @foreach ($group as $permission)
                                <x-admin.form.checkbox name="permissions[]" label="{{ $permission->description }}"
                                    value="{{ $permission->id }}" />
                            @endforeach
                        </section>
                    </details>
                @endforeach
            </div>

            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.actions.save') }}" />
                <x-admin.form.button href="{{ route('admin.role.index') }}"
                    label="{{ __('admin/common.actions.cancel') }}" />
            </div>
        </form>
@endsection 
