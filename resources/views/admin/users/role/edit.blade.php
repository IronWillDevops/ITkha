@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/role.title') }}
@endsection

@section('admin.content')
        <form action="{{ route('admin.role.update', $role) }}" method="POST">
            @csrf
            @method('PATCH')
            {{-- Название роли --}}
            <x-admin.form.input name="title" label="{{ __('admin/common.fields.title') }}" icon="fa-solid fa-user-plus"
                value="{{ $role->title }}" />

            {{-- Permissions --}}
            <div class="mb-6">
                <h2 class="font-semibold mb-2">{{ __('admin/role.permission.title') }}</h2>

                @foreach ($permissions as $header => $group)
                    <details class="group">
                        <summary class="cursor-pointer mb-4  focus:ring focus:outline-none focus-visible:ring-ring">
                            <span class="text-xl font-semibold">{{ $header }}</span>
                        </summary>
                        <section>
                            @foreach ($group as $permission)
                                 <x-admin.form.checkbox name="permissions[]" label="{{ $permission->description }}"
                                    value="{{ $permission->id }}"
                                    checked="{{ $role->permissions->contains($permission->id) ? true : false }}" /> 
                            @endforeach
                        </section>
                    </details>
                @endforeach
            </div>

            {{-- Кнопки --}}
            <div class="flex space-x-3">
                <x-admin.form.submit label="{{ __('admin/common.buttons.edit') }}" />
                <x-admin.form.button href="{{ route('admin.role.index') }}"
                    label="{{ __('admin/common.buttons.cancel') }}" />
            </div>
        </form>
@endsection
