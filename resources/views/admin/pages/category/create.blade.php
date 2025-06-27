@extends('admin.layouts.app')

@section('admin.content.header')
    Category
@endsection

@section('admin.content')
    <div class="row">
        <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Adding a category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title"
                                placeholder="Enter title" value='{{ old('title') }}'>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
