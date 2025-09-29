@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/tags.title') }} | {{ $tag->title }}
@endsection

@section('admin.content')

    <div class="flex items-center gap-4 mb-4">
        <x-admin.form.action-button type='link' route="{{ route('admin.tag.edit', $tag->id) }}" icon="fas fa-edit"
            label="{{ __('admin/tags.actions.edit') }}" />
        <x-admin.form.action-button type='form' method="DELETE" route="{{ route('admin.tag.delete', $tag->id) }}" icon="fas fa-trash-alt"
            label="{{ __('admin/tags.actions.delete') }}" />    
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

        @if ($posts->isNotEmpty())
            <ul class="list-disc list-inside space-y-1">
                @foreach ($posts as $post)
                    <li>
                        <span>{{ $post->id }})</span>
                        <a href="{{ route('admin.post.show', $post->id) }}"
                            class="hover:underline focus:ring focus:outline-none focus-visible:ring-ring">
                            {{ $post->title }}
                        </a>
                        <span class="text-xs text-muted-foreground">
                            ({{ $post->status }})
                        </span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-sm text-muted-foreground">
                {{ __('admin/posts.messages.no_posts') }}
            </p>
        @endif
        {{-- Пагинация --}}
        <div class="mt-6">
            {{ $posts->links('vendor.pagination.pagination') }}
        </div>
    </div>
@endsection
