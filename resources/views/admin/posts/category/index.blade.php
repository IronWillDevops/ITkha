@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/categories.title') }}
@endsection
@section('admin.content')
    <div class="flex items-center justify-between mb-6">
        <x-admin.form.action-button type='link' route="{{ route('admin.category.create') }}" icon="fa-solid fa-plus"
            label="{{ __('admin/categories.actions.create') }}" />

    </div>

    {{-- Таблица постов --}}
    <div class="overflow-x-auto shadow ">
        <table class="min-w-full divide-y ">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/categories.fields.id') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/categories.fields.title') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/categories.fields.count') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/categories.fields.created_at') }}
                    </th>
                    <th class="px-4 py-2 text-center text-sm font-semibold">{{ __('admin/common.actions.title') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y ">
                @forelse($categories as $category)
                    <tr>
                        <td class="px-4 py-2 text-sm ">{{ $category->id }}</td>
                        <td class="px-4 py-2 text-sm  font-medium  hover:underline">
                            <a href ="{{ route('admin.category.show', $category->id) }}"
                                class="focus:ring focus:outline-none focus-visible:ring-ring">{{ $category->title }}</a>
                        </td>
                        <td class="px-4 py-2 text-sm  font-medium ">
                            {{ $category->posts()->count() }}
                        </td>
                        <td class="px-4 py-2 text-sm">
                            {{ $category->created_at }}
                        </td>
                        <td class="px-4 py-2 text-sm text-right space-x-2 flex justify-end">
                            {{-- Кнопка редагування --}}
                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                class="focus:ring focus:outline-none focus-visible:ring-ring inline-flex items-center p-2 rounded-lg transition"
                                title="{{ __('admin/categories.actions.edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>

                            {{-- Кнопка видалення --}}
                            <form action="{{ route('admin.category.delete', $category->id) }}" method="POST"
                                onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center p-2 bg-destructive text-destructive-foreground rounded-lg transition focus:ring focus:outline-none focus-visible:ring-ring cursor-pointer"
                                    title="{{ __('admin/categories.actions.delete') }}">
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
        {{ $categories->links('vendor.pagination.pagination') }}
    </div>
@endsection
