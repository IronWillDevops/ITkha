@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/roles.title') }} | {{ $role->title }}
@endsection

@section('admin.content')
    <div class="flex items-center gap-4 mb-4">
        <x-admin.form.action-button type='link' route="{{ route('admin.role.edit', $role->id) }}" icon="fas fa-edit"
            label="{{ __('admin/roles.actions.edit') }}" />
        <x-admin.form.action-button type='form' method="DELETE" route="{{ route('admin.role.delete', $role->id) }}"
            icon="fas fa-trash-alt" label="{{ __('admin/roles.actions.delete') }}" />
    </div>



    {{-- Метаданные --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
        <div>
            <span class="font-medium">{{ __('admin/roles.fields.title') }}:</span>
            {{ $role->title }}
        </div>
        <div>
            <span class="font-medium">{{ __('admin/roles.fields.created_at') }}:</span>
            {{ $role->created_at }}
        </div>
    </div>

    <div>
        {{-- Permissions --}}

        <h2 class="font-semibold mb-2">{{ __('admin/permissions.title') }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($permissions as $header => $group)
                <div class="border border-border rounded-lg p-4 shadow-sm">
                    <h3 class="font-semibold text-lg mb-3">{{ $header }}</h3>
                    <ul class="space-y-1 text-sm">
                        @foreach ($group as $permission)
                            <li class="flex items-center gap-2">
                                @if ($role->permissions->contains($permission->id))
                                    <i class="fas fa-check text-success"></i>
                                @else
                                    <i class="fas fa-times text-error"></i>
                                @endif
                                <span>{{ $permission->description }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

    <div>
        <h2 class="font-semibold mb-2 mt-6">{{ __('admin/users.title') }}</h2>
        {{-- Таблица постов --}}
        <div class="overflow-x-auto shadow ">
            <table class="min-w-full divide-y ">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/users.fields.id') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/users.fields.login') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/users.fields.email') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/users.fields.role') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/users.fields.status') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/users.fields.count') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/users.fields.created_at') }}
                        </th>
                        <th class="px-4 py-2 text-center text-sm font-semibold">{{ __('admin/common.actions.title') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y ">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-4 py-2 text-sm ">{{ $user->id }}</td>
                            <td class="px-4 py-2 text-sm link  hover:underline "><a
                                    href="{{ route('admin.user.show', $user->id) }}"
                                    class="focus:ring focus:outline-none focus-visible:ring-ring">{{ $user->login }}</a>
                            </td>
                            <td class="px-4 py-2 text-sm ">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-sm link  hover:underline"><a
                                    href="{{ route('admin.role.show', $user->roles->first()->id) }}"
                                    class="focus:ring focus:outline-none focus-visible:ring-ring">{{ $user->roles->first()?->title }}</a>
                            </td>
                            <td class="px-4 py-2 text-sm ">{{ $user->status }}</td>
                            <td class="px-4 py-2 text-sm ">{{ $user->posts()->count() }}</td>

                            <td class="px-4 py-2 text-sm">
                                {{ $user->created_at }}
                            </td>
                            <td class="px-4 py-2 text-sm text-right space-x-2 flex justify-end">
                                {{-- Кнопка редагування --}}
                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                    class="focus:ring focus:outline-none focus-visible:ring-ring inline-flex items-center p-2 rounded-lg transition"
                                    title="{{ __('admin/users.actions.edit') }}">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Кнопка видалення --}}
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST"
                                    onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center p-2 bg-destructive text-destructive-foreground rounded-lg transition focus:ring focus:outline-none focus-visible:ring-ring cursor-pointer"
                                        title="{{ __('admin/users.actions.delete') }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-sm">
                                {{ __('admin/common.messages.no_records') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Пагинация --}}
        <div class="mt-6">
            {{ $users->links('vendor.pagination.pagination') }}
        </div>
    </div>
@endsection
