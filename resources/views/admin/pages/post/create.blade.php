@extends('admin.layouts.app')

@section('admin.content.header')
    Post
@endsection

@section('admin.content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Adding a post</h3>
        </div>
        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- /.card-header -->
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter title"
                                value="{{ old('title') }}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Main image</label>

                            <img id="main-image-preview" src="#" alt="Main"
                                style="max-height: 200px; object-fit: contain; display: block; margin-bottom: 10px;"
                                class="img-fluid d-none" />

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="main_image" id="main-image-input">
                                    <label class="custom-file-label" for="main-image-input">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            @error('main_image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Preview image</label>

                            <img id="preview-image-preview" src="#" alt="Preview" class="img-fluid d-none"
                                style="max-height: 200px; object-fit: contain; display: block; margin-bottom: 10px;" />

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="preview_image"
                                        id="preview-image-input">
                                    <label class="custom-file-label" for="preview-image-input">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            @error('preview_image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Choose category</label>
                            <select class="form-control" name='category_id'>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == old('category_id') ? ' selected' : '' }}>
                                        {{ $category->title }}</option>
                                @endforeach

                            </select>
                            @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Choose tags</label>
                            <select name="tag_ids[]" class="select2 select2-hidden-accessible" multiple="multiple"
                                data-placeholder="Select a tag" style="width: 100%;" data-select2-id="7" tabindex="-1"
                                aria-hidden="true">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ collect(old('tag_ids'))->contains($tag->id) ? 'selected' : '' }}>
                                        {{ $tag->title }}
                                    </option>
                                @endforeach

                            </select>
                            @error('tag_ids')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea id="summernote" name="content">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                @foreach (App\Enums\PostStatus::cases() as $status)
                                    <option value="{{ $status->value }}"
                                        {{ old('status', isset($post) ? $post->status->value : '') === $status->value ? 'selected' : '' }}>
                                        {{ $status->value }}
                                    </option>
                                @endforeach
                            </select>

                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="comments_enabled">Comments</label>
                            <select name="comments_enabled" id="comments_enabled" class="form-control">
                                <option value="1"
                                    {{ old('comments_enabled', $post->comments_enabled ?? true) ? 'selected' : '' }}>Yes
                                </option>
                                <option value="0"
                                    {{ old('comments_enabled', $post->comments_enabled ?? true) ? '' : 'selected' }}>No
                                </option>
                            </select>

                            @error('comments_enabled')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <select name="user_id" class="select2 select2-hidden-accessible" data-placeholder="Select a user"
                        style="width: 100%;" tabindex="-1" aria-hidden="true">

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ Auth::user()->id == $user->id ? ' selected' : '' }}>
                                {{ $user->login }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                </div>


            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
        <!-- /.card-body -->
    </div>
@endsection
@push('scripts')
    <script>
        function previewImage(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            input.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '#';
                    preview.classList.add('d-none');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            previewImage('main-image-input', 'main-image-preview');
            previewImage('preview-image-input', 'preview-image-preview');
        });
    </script>
@endpush
