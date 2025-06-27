@extends('admin.layouts.app')

@section('admin.content.header')
    Post
@endsection

@section('admin.content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Adding a social</h3>
        </div>
        <form action="{{ route('admin.settings.social.update',$link->id) }}" method="POST">
        
            @method('PATCH')
            @csrf
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" class="form-control" name="icon" placeholder="e.g fas fa-icons"
                                value="{{ $link->icon }}">
                            @error('icon')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter title"
                                value="{{ $link->title }}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url" placeholder="{{ config('app.url') }}"
                        value="{{ $link->url }}">
                    @error('url')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>

        </form>
        <!-- /.card-body -->
    </div>
@endsection
