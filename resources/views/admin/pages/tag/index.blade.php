@extends('admin.layouts.app')

@section('admin.content.header')
    Tag
@endsection

@section('admin.content')
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="btn-group">
                <a href="{{ route('admin.tag.create') }}" type="button" class="btn btn-info"><i class="fa fa-plus"></i> Add</a>
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
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td class="align-middle">{{ $tag->id }}.</td>
                                    <td class="align-middle">{{ $tag->title }}</td>
                                    <td class="align-middle">
                                        <div class='btn-group'>
                                            <a href="{{ route('admin.tag.show', $tag->id) }}" class="btn btn-default"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.tag.edit', $tag->id) }}" class="btn btn-default"><i
                                                    class="fas fa-pen"></i></a>

                                        </div>
                                        <div class='btn-group'>
                                            <form action="{{ route('admin.tag.delete', $tag->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-default"><a
                                                        href="{{ route('admin.tag.delete', $tag->id) }}"
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
            </div>

        </div>
        <!-- /.card-body -->
    </div>
@endsection
