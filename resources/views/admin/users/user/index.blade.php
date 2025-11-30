@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/user.title') }}
@endsection
@section('admin.content')
    <div class="flex items-center justify-between mb-6">
        <x-admin.form.action-button type="link" route="{{ route('admin.user.create') }}" icon="fa-solid fa-plus"
            label=" {{ __('admin/common.buttons.create') }}" />
    </div>

    {{-- Таблица постов --}}
    <div class="overflow-x-auto shadow ">
        <table class="min-w-full divide-y ">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/common.fields.id') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/user.fields.login') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/common.fields.email') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/common.fields.role') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/common.fields.status') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/common.fields.count') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/common.fields.created_at') }}</th>
                    <th class="px-4 py-2 text-center text-sm font-semibold">{{ __('admin/common.fields.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y ">
                @forelse($users as $user)
                    <tr>
                        <td class="px-4 py-2 text-sm ">{{ $user->id }}</td>
                        <td class="px-4 py-2 text-sm link  hover:underline "><a
                                href="{{ route('admin.user.show', $user) }}"
                                class="focus:ring focus:outline-none focus-visible:ring-ring">{{ $user->login }}</a></td>
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
                            <a href="{{ route('admin.user.edit', $user) }}"
                                class="focus:ring focus:outline-none focus-visible:ring-ring inline-flex items-center p-2 rounded-lg transition"
                                title="{{ __('admin/common.buttons.edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>

                            {{-- Кнопка видалення --}}
                            <form action="{{ route('admin.user.delete', $user) }}" method="POST"
                                onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center p-2 bg-destructive text-destructive-foreground rounded-lg transition focus:ring focus:outline-none focus-visible:ring-ring cursor-pointer"
                                    title="{{ __('admin/common.buttons.delete') }}">
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
@endsection
