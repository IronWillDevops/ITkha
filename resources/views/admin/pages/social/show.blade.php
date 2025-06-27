@extends('admin.layouts.app')

@section('admin.content.header')
    Social links
@endsection

@section('admin.content')
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="btn-group">
                <a href="{{ route('admin.settings.social.create') }}" type="button" class="btn btn-info"><i class="fa fa-plus"></i>
                    Add</a>
                <a href="{{ route('admin.settings.social.edit',$link->id) }}" type="button" class="btn btn-default"><i
                        class="fa fa-edit"></i> Edit</a>
            </div>
            <div class="btn-group">
                <form action="{{ route('admin.settings.social.delete',$link->id) }}" method="POST">
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
                    <h3 class="card-title">All social link</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $link->id }}</td>

                            </tr>
                            <tr>
                                <td>Icon</td>
                                <td><i class="fab {{ $link->icon }}"></i></td>

                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>{{ $link->title }}</td>

                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>{{ $link->url }}</td>
                            </tr>
                            
                            <tr>
                                <td>Create At</td>
                                <td>{{ $link->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Update At</td>
                                <td>{{ $link->updated_at }}</td>
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
