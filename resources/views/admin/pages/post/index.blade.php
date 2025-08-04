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
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All posts</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Category</th>

                                <th>Tags</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Created at</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="align-middle">{{ $post->id }}.</td>

                                    <td class="align-middle"><a href="{{ route('admin.post.show',$post->id) }}">{{ $post->title }}</a></td>
                                    <td class="align-middle"><a href="{{ route('admin.category.show',$post->category->id) }}">{{ $post->category->title }}</a></td>
                                    <td class="align-middle">
                                        @foreach ($post->tags as $tag)
                                            #{{ $tag->title }}
                                        @endforeach
                                    </td>

                                    <td class="align-middle">{{ $post->status }}</td>
                                    <td class="align-middle"><a href="{{ route('admin.user.show',$post->author->id) }}">{{ $post->author->login }}</a></td>
                                    <td class="align-middle">{{ $post->created_at }}</td>
                                    <td class="align-middle">
                                        <div class='btn-group'>
                                            <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-default"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-default"><i
                                                    class="fas fa-pen"></i></a>

                                        </div>
                                        <div class='btn-group'>
                                            <form action="{{ route('admin.post.delete', $post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-default"><a
                                                        href="{{ route('admin.post.delete', $post->id) }}"
                                                        onclick="return confirm('Sure delete?')" class="text-danger">
                                                        <i class="fa fa-trash"></i></a></button>

                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
@endsection
