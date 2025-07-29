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
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Login</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="align-middle">{{ $user->id }}.</td>
                                    <td class="align-middle">
                                        @if ($user->status === \App\Enums\UserStatus::ACTIVE->value)
                                            <i class=" fa fa-user-check"></i>
                                        @else
                                            <i class=" fa fa-user-times"></i>
                                        @endif
                                        <span class="ml-2">{{ $user->name }}</span>
                                    </td>
                                    <td class="align-middle">{{ $user->login }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">{{ $user->roles->first()?->title }}</td>
                                    <td class="align-middle">
                                        <div class='btn-group'>
                                            <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-default"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-default"><i
                                                    class="fas fa-pen"></i></a>

                                        </div>
                                        <div class='btn-group'>
                                            <form action="{{ route('admin.user.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-default"><a
                                                        href="{{ route('admin.user.delete', $user->id) }}"
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
