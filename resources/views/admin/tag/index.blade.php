@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/tags.title') }}
@endsection
@section('admin.content')
    <div class="mx-auto p-4 bg-surface border border-border rounded-lg text-text-primary">
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('admin.tag.create') }}"
                class="px-4 py-2 border border-border rounded-xl shadow transition">
                {{ __('admin/tags.actions.create') }}
            </a>
        </div>

        {{-- Таблица постов --}}
        <div class="overflow-x-auto shadow ">
            <table class="min-w-full divide-y ">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/tags.fields.id') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/tags.fields.title') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/tags.fields.count') }}</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/tags.fields.created_at') }}
                        </th>
                        <th class="px-4 py-2 text-center text-sm font-semibold">{{ __('admin/common.actions.title') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y ">
                    @forelse($tags as $tag)
                        <tr>
                            <td class="px-4 py-2 text-sm ">{{ $tag->id }}</td>
                            <td class="px-4 py-2 text-sm  font-medium link hover:link-hover hover:underline">
                                <a href ="{{ route('admin.tag.show',$tag->id) }}">{{ $tag->title }}</a>
                            </td>
                            <td class="px-4 py-2 text-sm  font-medium ">
                                {{ $tag->posts()->count() }}
                            </td>
                            <td class="px-4 py-2 text-sm">
                                {{ $tag->created_at }}
                            </td>
                            <td class="px-4 py-2 text-sm text-right space-x-2 flex justify-end">
                                {{-- Кнопка редагування --}}
                                <a href="{{ route('admin.tag.edit',$tag->id) }}" class="inline-flex items-center p-2 rounded-lg transition" title="#">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Кнопка видалення --}}
                                <form action="{{ route('admin.tag.delete',$tag->id) }}" method="POST"
                                    onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center p-2 text-text-danger rounded-lg transition cursor-pointer"
                                        title="#">
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
            {{ $tags->links('vendor.pagination.pagination') }}
        </div>
    </div>
@endsection
