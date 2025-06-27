@extends('admin.layouts.app')

@section('admin.content.header')
    User
@endsection

@section('admin.content')

 <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="btn-group">
                <a href="{{ route('admin.user.create') }}" type="button" class="btn btn-info"><i class="fa fa-plus"></i>
                    Add</a>
                <a href="{{ route('admin.user.edit', $user->id) }}" type="button" class="btn btn-default"><i
                        class="fa fa-edit"></i> Edit</a>
            </div>
            <div class="btn-group">
                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST">
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
                    <h3 class="card-title">All users</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Login</td>
                                <td>{{ $user->login }}</td>
                            </tr>
                            <tr>
                                <td>Surname</td>
                                <td>{{ $user->surname }}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>{{ $user->roles->first()?->title ?? '—' }}</td>
                            </tr><tr>
                                <td>Status</td>
                                <td>{{ $user->is_active===1?"Active":"Disable" }}</td>
                            </tr>
                            <tr>
                                <td>Create At</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Update At</td>
                                <td>{{ $user->updated_at }}</td>

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
