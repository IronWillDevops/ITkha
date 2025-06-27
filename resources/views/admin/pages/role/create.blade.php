@extends('admin.layouts.app')

@section('admin.content.header')
    Role
@endsection

@section('admin.content')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Adding a role</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('admin.role.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title"
                                placeholder="Enter title" value='{{ old('title') }}'>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <h4>Permission</h4>
                <div class="form-group">


                    @foreach ($permissions as $header => $group)
                        <h4>{{ $header }}</h4>
                        <ul>
                            @foreach ($group as $permission)

                            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                        value="{{ $permission->id }}">
                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                        {{ $permission->description ?? $permission->title }} </label>
                                </div>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>


    <!-- /.card -->
@endsection
