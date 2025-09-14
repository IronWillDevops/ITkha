@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/users.title') }}
@endsection
@section('admin.content')
    <div class=" mx-auto p-4 bg-surface border border-border rounded-lg text-text-primary">
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('admin.user.create') }}" class="px-4 py-2 border border-border rounded-xl shadow transition">
                {{ __('admin/users.actions.create') }}
            </a>
        </div>

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
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/users.fields.created_at') }}</th>
                        <th class="px-4 py-2 text-center text-sm font-semibold">{{ __('admin/common.actions.title') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y ">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-4 py-2 text-sm ">{{ $user->id }}</td>
                            <td class="px-4 py-2 text-sm link hover:link-hover hover:underline "><a href="{{ route('admin.user.show',$user->id) }}">{{ $user->login }}</a></td>
                            <td class="px-4 py-2 text-sm ">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-sm link hover:link-hover hover:underline"><a href="{{ route('admin.role.show',$user->roles->first()->id) }}">{{ $user->roles->first()?->title }}</a></td>
                            <td class="px-4 py-2 text-sm ">{{ $user->status }}</td>
                            <td class="px-4 py-2 text-sm ">{{ $user->posts()->count() }}</td>

                            <td class="px-4 py-2 text-sm">
                                {{ $user->created_at }}
                            </td>
                            <td class="px-4 py-2 text-sm text-right space-x-2 flex justify-end">
                                {{-- Кнопка редагування --}}
                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                    class="inline-flex items-center p-2 rounded-lg transition" title="{{ __('admin/users.actions.edit') }}">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Кнопка видалення --}}
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST"
                                    onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center p-2 text-text-danger rounded-lg transition cursor-pointer"
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
