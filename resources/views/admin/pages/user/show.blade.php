@extends('admin.layouts.app')

@section('admin.content.header')
    User
@endsection

@section('admin.content')

    <div class="row">
        <div class="col-md-4">
            <div class="card card-light">
                <div class="card-body text-center">
                    
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" data-filename="image.png"
                                alt="{{ $user->name }}" class="img-size-64 img-circle   img-bordered-sm" >
                      
                        @endif

                    <h3 class="profile-username">{{ $user->name }} {{ $user->surname }}</h3>
                    <p class="text-muted">{{ $user->profile?->job_title }}</p>

                    <ul class="list-group list-group-unbordered text-left mb-3">
                        <li class="list-group-item">
                            <b>Login:</b><span class="float-right">{{ $user->login }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Email:</b><span class="float-right">{{ $user->email }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Status:</b><span class="float-right">{{ $user->status }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Role:</b><span class="float-right"><a href="{{ route('admin.role.show', $user->roles->first()?->id) }}">{{ $user->roles->first()?->title }}</a></span>
                        </li>
                    </ul>

                    <div class="d-flex">
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary flex-fill mr-1"
                            style="flex: 0 0 75%;">
                            <i class="fas fa-user-edit"></i> Edit
                        </a>

                        <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" style="flex: 0 0 25%;"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-user-times"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if ($user->profile && ($user->profile->github || $user->profile->linkedin || $user->profile->website))
                <div class="card card-light">
                    <div class="card-header">
                        <h3 class="card-title">Social Media</h3>
                    </div>
                    <div class="card-body text-center">
                        @if ($user->profile->github)
                            <a href="{{ $user->profile->github }}" target="_blank" class="btn btn-dark btn-sm ">
                                <i class="fab fa-github mr-2"></i>GitHub
                            </a>
                        @endif
                        @if ($user->profile->linkedin)
                            <a href="{{ $user->profile->linkedin }}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="fab fa-linkedin mr-2"></i>LinkedIn
                            </a>
                        @endif
                        @if ($user->profile->website)
                            <a href="{{ $user->profile->website }}" target="_blank" class="btn btn-secondary btn-sm">
                                <i class="fas fa-globe mr-2"></i>Website
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">About us</h3>
                </div>
                <div class="card-body">
                    @if ($user->profile && $user->profile->about_myself)
                        <p>{{ $user->profile->about_myself }}</p>
                    @else
                        <p class="text-muted">There is no information</p>
                    @endif
                    @if ($user->profile && $user->profile->address)
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                        <p class="text-muted">{{ $user->profile->address }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
