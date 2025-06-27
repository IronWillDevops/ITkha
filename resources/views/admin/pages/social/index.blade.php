@extends('admin.layouts.app')

@section('admin.content.header')
    Social links
@endsection

@section('admin.content')
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="btn-group">
                <a href="{{ route('admin.settings.social.create') }}" type="button" class="btn btn-info"><i
                        class="fa fa-plus"></i>
                    Add</a>
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All social links</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Icon</th>
                                <th>URL</th>
                                <th>Created at</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($socialLinks  as $link)
                                <tr>
                                    <td class="align-middle">{{ $link->id }}.</td>
                                    <td class="align-middle"><i class="fab {{ $link->icon }}"></i></td>
                                    <td class="align-middle">
                                        <a href="{{ $link->url }}" target="_blank">{{ $link->title }}</a>
                                    </td>
                                    <td class="align-middle">{{ $link->created_at }}</td>
                                    <td class="align-middle">
                                        <div class='btn-group'>
                                            <a href="{{ route('admin.settings.social.show',$link->id)  }}" class="btn btn-default"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.settings.social.edit',$link->id) }}" class="btn btn-default"><i class="fas fa-pen"></i></a>
                                        </div>
                                        <div class='btn-group'>
                                            <form action="{{ route('admin.settings.social.delete',$link->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-default">
                                                    <a href="{{ route('admin.settings.social.delete',$link->id) }}" onclick="return confirm('Sure delete?')"
                                                        class="text-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </button>

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
