@extends('admin.layouts.app')

@section('admin.content.title')
    {{ __('admin/comment.title') }} | {{ Str::limit(strip_tags(html_entity_decode($comment->body)), 50) }}
@endsection

@section('admin.content')
    <div class="flex items-center gap-4 mb-4">
        <x-form.table-actions type='link' route="{{ route('admin.comment.edit', $comment->id) }}" icon="fas fa-edit"
            label="{{ __('admin/common.buttons.edit') }}" />
        <x-form.table-actions type='form' method="DELETE" route="{{ route('admin.comment.delete', $comment->id) }}"
            icon="fas fa-trash-alt" label="{{ __('admin/common.buttons.delete') }}" variant="destructive" :confirm="true" />
    </div>

    {{-- Метаданные --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
        <div>
            <span class="font-medium">{{ __('admin/comment.fields.body') }}:</span>
            {{ $comment->body }}
        </div>
        <div>
            <span class="font-medium">{{ __('admin/common.fields.status') }}:</span>
            {{ $comment->status }}
        </div>
        <div>
            <span class="font-medium">{{ __('admin/common.fields.author') }}:</span>
            <a href="{{ route('admin.user.show', $comment->user) }}"
                class="hover:underline">{{ $comment->user->login }}</a>
        </div>
        <div>
            <span class="font-medium">{{ __('admin/common.fields.created_at') }}:</span>
            {{ $comment->created_at }}
        </div>
    </div>

    {{-- Таблица связанного поста --}}
    <div class="border-t border-border pt-4 mb-6">
        <h2 class="text-lg font-semibold mb-2">
            {{ __('admin/common.fields.post') }}
        </h2>

        @if ($posts->isNotEmpty())
            <x-form.table :columns="$columns" :items="$posts" modelRoute="post" :sortField="'id'" :sortDirection="'desc'"
                searchEnabled="false" />
        @else
            <p class="text-sm text-muted-foreground">
                {{ __('admin/common.messages.no_records') }}
            </p>
        @endif
    </div>
@endsection
