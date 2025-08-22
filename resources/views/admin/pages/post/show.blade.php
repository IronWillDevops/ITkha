@extends('admin.layouts.app')

@section('admin.content.header')
    Post
@endsection

@section('admin.content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Пост -->
            <div class="card border-0 shadow-sm w-100">
                <div class="card-header">
                    <div class="btn-group">
                        <a href="{{ route('admin.post.create') }}" type="button" class="btn btn-info"><i
                                class="fa fa-plus"></i>
                            Add</a>
                        <a href="{{ route('admin.post.edit', $post->id) }}" type="button" class="btn btn-default"><i
                                class="fa fa-edit"></i> Edit</a>
                    </div>
                    <div class="btn-group">
                        <form action="{{ route('admin.post.delete', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Sure delete?')">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">

                    <!-- Заголовок + Дії -->
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h2 class="mb-1">{{ $post->title }}</h2>
                            <div class="text-muted">
                                <small>Created at: {{ $post->created_at->format('d.m.Y H:i') }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Зображення + Інфо -->
                    <div class="row mb-4">
                        @if ($post->main_image)
                            <div class="col-md-8 mb-3 mb-md-0">
                                <img src="{{ asset('storage/' . $post->main_image) }}" class="img-fluid rounded w-100"
                                    style="max-height: 400px; object-fit: cover;" alt="Image post">
                            </div>
                        @endif

                        <div class="col-md-4">
                            <div class="mb-3">
                                <strong>Author:</strong><br>
                                <a href="{{ route('admin.user.show', $post->author->id) }}">
                                    {{ $post->author->login ?? '—' }}</a>
                            </div>

                            <div class="mb-3">
                                <strong>Category:</strong><br>
                                {{ $post->category->title ?? '—' }}
                            </div>

                            <div class="mb-3">
                                <strong>Status:</strong><br>

                                <span
                                    class="badge badge-{{ $post->status === \App\Enums\PostStatus::PUBLISHED->value ? 'success' : 'secondary' }}">
                                    {{ $post->status }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <strong>Tags:</strong><br>
                                @forelse ($post->tags as $tag)
                                    <span class="badge badge-light border text-dark">{{ $tag->title }}</span>
                                @empty
                                    <span class="text-muted">—</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Контент -->
                    <div>
                        <strong>Content:</strong>
                        <div class="border rounded p-3 bg-light mt-2">
                            {!! $post->content !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
