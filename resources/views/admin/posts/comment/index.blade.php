@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/comments.title') }}
@endsection
@section('admin.content')
    {{-- Таблица постов --}}
    <div class="overflow-x-auto shadow ">
        <table class="min-w-full divide-y ">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/comments.fields.id') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/comments.fields.body') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/comments.fields.author') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/comments.fields.post') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/comments.fields.status') }}</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">{{ __('admin/comments.fields.created_at') }}</th>
                    <th class="px-4 py-2 text-center text-sm font-semibold">{{ __('admin/common.actions.title') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y ">
                @forelse($comments as $comment)
                    <tr>
                        <td class="px-4 py-2 text-sm ">{{ $comment->id }}</td>
                        <td class="px-4 py-2 text-sm  font-medium link  hover:underline">
                            <a href ="{{ route('admin.comment.show', $comment->id) }}"
                                class="focus:ring focus:outline-none focus-visible:ring-ring"> {{ Str::limit(strip_tags(html_entity_decode( $comment->body )), 50) }}</a> 
                           
                        </td>
                        <td class="px-4 py-2 text-sm  font-medium hover:underline">
                            <a href ="{{ route('admin.user.show', $comment->user) }}"
                                class="focus:ring focus:outline-none focus-visible:ring-ring">{{ $comment->user->login }}</a>
                        </td>
                        <td class="px-4 py-2 text-sm  font-medium hover:underline">
                            <a href ="{{ route('admin.post.show', $comment->post) }}"
                                class="focus:ring focus:outline-none focus-visible:ring-ring">{{ $comment->post->title }}</a>
                        </td>
                        <td class="px-4 py-2 text-sm  font-medium ">
                            {{ $comment->status}}
                        </td>
                        <td class="px-4 py-2 text-sm">
                            {{ $comment->created_at }}
                        </td>
                        <td class="px-4 py-2 text-sm text-right space-x-2 flex justify-end">
                            {{-- Кнопка редагування --}}
                            <a href="{{ route('admin.comment.edit', $comment->id) }}"
                                class="inline-flex items-center p-2 rounded-lg transition focus:ring focus:outline-none focus-visible:ring-ring"
                                title="{{ __('admin/comments.actions.edit') }}">
                                <i class="fas fa-edit"></i>
                            </a> 

                            {{-- Кнопка видалення --}}
                             <form action="{{ route('admin.comment.delete', $comment->id) }}" method="POST"
                                onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center p-2 bg-destructive text-destructive-foreground rounded-lg transition focus:ring focus:outline-none focus-visible:ring-ring cursor-pointer"
                                    title="{{ __('admin/comments.actions.delete') }}">
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
        {{ $comments->links('vendor.pagination.pagination') }}
    </div>
@endsection
