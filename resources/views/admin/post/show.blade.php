@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/posts.title') }} | {{ $post->title }}
@endsection
@section('admin.content')
    <div class=" mx-auto p-4 bg-surface border border-border rounded-lg text-text-primary">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.post.edit', $post->id) }}"
                class="px-4 py-2 border border-border rounded-xl shadow transition">
                <i class="fas fa-edit"></i> {{ __('admin/posts.actions.edit') }}
            </a>

            <form action="{{ route('admin.post.delete', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 border border-border rounded-xl shadow transition text-text-danger"
                    onclick="return confirm('{{ __('admin/common.messages.confirm_delete') }}')">
                    <i class="fas fa-trash-alt"></i> {{ __('admin/posts.actions.delete') }}
                </button>
            </form>

        </div>

        {{-- Основное изображение --}}
        @if ($post->main_image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $post->main_image) }}" alt="{{ $post->title }}"
                    class="w-full max-h-96 object-cover rounded-xl shadow">
            </div>
        @endif

        {{-- Метаданные --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 text-sm">
            <div>
                <span class="font-medium">{{ __('admin/posts.fields.status') }}:</span>
                <span class="px-2 py-1 rounded-lg text-xs">{{ $post->status }}</span>
            </div>
            <div>
                <span class="font-medium">{{ __('admin/posts.fields.categories') }}:</span>
                {{ $post->category?->title }}
            </div>
            <div>
                <span class="font-medium">{{ __('admin/posts.fields.created_at') }}:</span>
                {{ $post->created_at }}
            </div>
            <div>
                <span class="font-medium">{{ __('admin/posts.fields.author') }}:</span>
                {{ $post->author->login }}
            </div>

            <div>
                <span class="font-medium">{{ __('admin/posts.fields.tags') }}:</span>
                @forelse($post->tags as $tag)
                    <span class="">
                        #{{ $tag->title }}
                    </span>
                @empty
                    <span class="text-xs text-text-secondary">-</span>
                @endforelse
            </div>
        </div>



        {{-- Контент --}}
        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>
    </div>
@endsection
