@extends('admin.layouts.app')
@section('admin.content.title')
    {{ __('admin/post.title') }} | {{ $post->title }}
@endsection
@section('admin.content')
    <div class="flex items-center gap-4 mb-4">
        <x-admin.form.action-button type='link' route="{{ route('admin.post.edit', $post) }}" icon="fas fa-edit"
            label="{{ __('admin/common.buttons.edit') }}" />
        <x-admin.form.action-button type='form' method="DELETE" route="{{ route('admin.post.delete', $post) }}"
            icon="fas fa-trash-alt" label="{{ __('admin/common.buttons.delete') }}" />
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
            <span class="font-medium">{{ __('admin/common.fields.status') }}:</span>
            <span class="px-2 py-1 rounded-lg text-xs">{{ $post->status }}</span>
        </div>
        <div>
            <span class="font-medium">{{ __('admin/common.fields.category') }}:</span>
            {{ $post->category?->title }}
        </div>
        <div>
            <span class="font-medium">{{ __('admin/common.fields.created_at') }}:</span>
            {{ $post->created_at }}
        </div>
        <div>
            <span class="font-medium">{{ __('admin/common.fields.author') }}:</span>
            {{ $post->author->login }}
        </div>

        <div>
            <span class="font-medium">{{ __('admin/common.fields.tag') }}:</span>
            @forelse($post->tags as $tag)
                <span class="">
                    #{{ $tag->title }}
                </span>
            @empty
                <span class="text-xs text-text-secondary">-</span>
            @endforelse
        </div>
        
        <div>
            <span class="font-medium">{{ __('admin/common.fields.slug') }}:</span>
            {{ $post->slug }}
        </div>
    </div>



    {{-- Контент --}}
    <div class="prose max-w-none" id="post-content">
        {!! $post->content !!}
    </div>
@endsection
