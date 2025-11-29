@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/posts.title') }}
@endsection
@section('admin.content')

    <div class="flex items-center justify-between mb-6">
        <x-admin.form.action-button type='link' route="{{ route('admin.post.create') }}" icon="fa-solid fa-plus"
            label="{{ __('admin/posts.actions.create') }}" />   
    </div>

    {{-- Таблица постов --}}
    <div class="overflow-x-auto shadow ">
        <table class="min-w-full divide-y ">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.id') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.title') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.categories') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.tags') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.status') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/posts.fields.created_at') }}</th>
                    <th class="px-4 py-2 text-center text-sm font-semibold">{{ __('admin/common.actions.title') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y ">
                @forelse($posts as $post)
                    <tr>
                        <td class="px-4 py-2 text-sm ">{{ $post->id }}</td>
                        <td class="px-4 py-2 text-sm  font-medium  hover:underline">
                            <a href ="{{ route('admin.post.show', $post) }}"
                                class="focus:ring focus:outline-none focus-visible:ring-ring">{{ $post->title }}</a>
                        </td>
                        <td class="px-4 py-2 text-sm font-medium  hover:underline">
                            <a href="{{ route('admin.post.show', $post) }}"
                                class="focus:ring focus:outline-none focus-visible:ring-ring">
                                {{ $post->category->title }}
                            </a>
                        </td>
                        <td class="px-4 py-2 text-sm ">
                            @forelse($post->tags as $tag)
                                <span class="inline-block  px-2 py-0.5 rounded-lg text-xs">
                                    {{ $tag->title }}
                                </span>
                            @empty
                                <span class=" text-xs">-</span>
                            @endforelse
                        </td>
                        <td class="px-4 py-2 text-sm">
                            <span class="px-2 py-1 rounded-lg text-xs">
                                {{ $post->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-sm">
                            {{ $post->created_at }}
                        </td>
                        <td class="px-4 py-2 text-sm text-right space-x-2 flex justify-end ">
                            {{-- Кнопка редагування --}}
                            <a href="{{ route('admin.post.edit', $post) }}"
                                class="inline-flex items-center p-2 rounded-lg transition focus:ring focus:outline-none focus-visible:ring-ring"
                                title="{{ __('admin/posts.actions.edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>

                            {{-- Кнопка видалення --}}
                            <form action="{{ route('admin.post.delete', $post) }}" method="POST"
                                onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center p-2 bg-destructive text-destructive-foreground rounded-lg transition focus:ring focus:outline-none focus-visible:ring-ring cursor-pointer"
                                    title="{{ __('admin/posts.actions.delete') }}">
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
        {{ $posts->links('vendor.pagination.pagination') }}
    </div>
@endsection
