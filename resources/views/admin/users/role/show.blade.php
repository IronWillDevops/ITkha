@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/role.title') }} | {{ $role->title }}
@endsection

@section('admin.content')
    <div class="flex items-center gap-4 mb-4">
        <x-form.table-actions type='link' route="{{ route('admin.role.edit', $role) }}" icon="fas fa-edit"
            label="{{ __('admin/common.buttons.edit') }}" />
        <x-form.table-actions type='form' method="DELETE" route="{{ route('admin.role.delete', $role) }}"
            icon="fas fa-trash-alt" label="{{ __('admin/common.buttons.delete') }}" />
    </div>



    {{-- Метаданные --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm ">
        <div>
            <span class="font-medium">{{ __('admin/common.fields.title') }}:</span>
            {{ $role->title }}
        </div>
        <div>
            <span class="font-medium">{{ __('admin/common.fields.created_at') }}:</span>
            {{ $role->created_at }}
        </div>
    </div>

    <div class="border-t border-border pt-4 mb-6">
        {{-- Permissions --}}

        <h2 class="text-lg font-semibold mb-2">{{ __('admin/permission.title') }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($permissions as $header => $group)
                <div class="border border-border rounded-lg p-4 shadow-sm">
                    <h3 class="font-semibold text-lg mb-3">{{ __('admin/permission.' . $header . '.label') }}</h3>
                    <ul class="space-y-1 text-sm">
                        @foreach ($group as $permission)
                            <li class="flex items-center gap-2">
                                @if ($role->permissions->contains($permission->id))
                                    <i class="fas fa-check text-success"></i>
                                @else
                                    <i class="fas fa-times text-error"></i>
                                @endif
                                <span>{{ __('admin/permission.' . $permission->key) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

        </div>
    </div>

    <div class="border-t border-border pt-4">
        <h2 class="text-lg font-semibold mb-2">
            {{ __('admin/user.title') }}
        </h2>
        <x-form.table :columns="$columns" :items="$users" modelRoute="user" :sortField="$sortField" :sortDirection="$sortDirection"
            searchEnabled="true" />
        
    </div>
@endsection
