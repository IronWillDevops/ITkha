@extends('admin.layouts.app')

@section('admin.content.header')
    Post
@endsection

@section('admin.content')
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="btn-group">
                <a href="{{ route('admin.post.create') }}" type="button" class="btn btn-info"><i class="fa fa-plus"></i>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All categories</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $post->id }}</td>

                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>{{ $post->title }}</td>

                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>{{ $post->category->title }}</td>

                            </tr>
                            <tr>
                                <td>Tags</td>
                                <td>
                                    @foreach ($post->tags as $tag)
                                        #{{ $tag->title }}
                                    @endforeach
                                </td>

                            </tr>
                            <tr>
                                <td>Create At</td>
                                <td>{{ $post->created_at }}</td>

                            </tr>
                            <tr>
                                <td>Update At</td>
                                <td>{{ $post->updated_at }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                
            </div>

        </div>
        <!-- /.card-body -->
    </div>
@endsection
