@extends('admin.layouts.app')

@section('admin.content.header')
    User
@endsection

@section('admin.content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Editing a user</h3>
        </div>
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <!-- /.card-header -->
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter name"
                                value="{{ $user->name }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>SurName</label>
                        <input type="text" class="form-control" name="surname" placeholder="Enter surname"
                            value="{{ $user->surname }}">
                        @error('surname')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" class="form-control" name="login" placeholder="Enter login"
                                value="{{ $user->login }}">
                            @error('login')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email"
                        value="{{ $user->email }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name='role_id'>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $user->roles->first()?->id == $role->id ? ' selected' : '' }}>
                                        {{ $role->title }}</option>
                                @endforeach

                            </select>
                            @error('role_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            @error('login')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Confirmation password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Confirmation password">

                            @error('login')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name='status'>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->value }}"
                                        {{ $user->status === $status->value ? 'selected' : '' }}>
                                        {{ $status->value }}
                                    </option>
                                @endforeach

                            </select>
                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="hidden" name="email_verified_at" value="0">
                        <input type="checkbox" class="custom-control-input" name="email_verified_at" id="email_verified_at"
                            value="1" {{ !empty($user->email_verified_at) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="email_verified_at">Is verified</label>
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
        <!-- /.card-body -->
    </div>
@endsection
