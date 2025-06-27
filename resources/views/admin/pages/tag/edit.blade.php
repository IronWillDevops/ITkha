@extends('admin.layouts.app')

@section('admin.content.header')
    Tag
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Editing a tag</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.tag.update', $tag->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title"
                                placeholder="Enter title" value="{{ $tag->title }}">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
