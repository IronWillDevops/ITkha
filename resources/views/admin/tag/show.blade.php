@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/tags.title') }} | {{ $tag->title }}
@endsection

@section('admin.content')
    <div class="mx-auto p-4 bg-surface border border-border rounded-lg text-text-primary">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.tag.edit', $tag->id) }}"
               class="px-4 py-2 border border-border rounded-xl shadow transition">
                <i class="fas fa-edit"></i> {{ __('admin/tags.actions.edit') }}
            </a>

            <form action="{{ route('admin.tag.delete', $tag->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 border border-border rounded-xl shadow transition text-text-danger"
                        onclick="return confirm('{{ __('admin/common.messages.confirm_delete') }}')">
                    <i class="fas fa-trash-alt"></i> {{ __('admin/tags.actions.delete') }}
                </button>
            </form>
        </div>

        {{-- Метаданные --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
            <div>
                <span class="font-medium">{{ __('admin/tags.fields.title') }}:</span>
                {{ $tag->title }}
            </div>
            <div>
                <span class="font-medium">{{ __('admin/tags.fields.created_at') }}:</span>
                {{ $tag->created_at }}
            </div>
        </div>

        {{-- Связанные посты --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">
                {{ __('admin/tags.fields.posts') }}
            </h2>

            @if($posts->isNotEmpty())
                <ul class="list-disc list-inside space-y-1">
                    @foreach($posts as $post)
                        <li>
                            <span>{{ $post->id }})</span>
                            <a href="{{ route('admin.post.show', $post->id) }}"
                               class="link hover:link-hover hover:underline">
                                {{ $post->title }}
                            </a>
                            <span class="text-xs text-text-secondary">
                                ({{ $post->status }})
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-text-secondary">
                    {{ __('admin/posts.messages.no_posts') }}
                </p>
            @endif
            {{-- Пагинация --}}
        <div class="mt-6">
            {{$posts->links('vendor.pagination.pagination') }}
        </div>
        </div>
    </div>
@endsection
