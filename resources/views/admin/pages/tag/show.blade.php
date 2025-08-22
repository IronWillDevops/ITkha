@extends('admin.layouts.app')

@section('admin.content.header')
    Tag
@endsection

@section('admin.content')
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="btn-group">
                <a href="{{ route('admin.tag.create') }}" type="button" class="btn btn-info"><i class="fa fa-plus"></i>
                    Add</a>
                <a href="{{ route('admin.tag.edit', $tag->id) }}" type="button" class="btn btn-default"><i
                        class="fa fa-edit"></i> Edit</a>
            </div>
            <div class="btn-group">
                <form action="{{ route('admin.tag.delete', $tag->id) }}" method="POST">
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
                    <h3 class="card-title">All tags</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $tag->id }}</td>

                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>{{ $tag->title }}</td>

                            </tr>
                            <tr>
                                <td>Create At</td>
                                <td>{{ $tag->created_at }}</td>

                            </tr>
                            <tr>
                                <td>Update At</td>
                                <td>{{ $tag->updated_at }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
        <!-- /.card-body -->
    </div>

    <div class="card card-default color-palette-box">
        <div class="card-header">
            <h3 class="card-title mb-0">
                <i class="fas fa-newspaper"></i> Posts with this tag
            </h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td><a href="{{ route('admin.post.show', $post->id) }}">{{ $post->title }}</a></td>
                            <td>{{ $post->status }}</td>
                            <td>{{ $post->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No posts found for this tag</td>
                        </tr>
                    @endforelse
                </tbody>
                
            </table><div class="card-footer clearfix">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
        </div>
    </div>
@endsection
