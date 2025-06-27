@extends('admin.layouts.app')
@section('admin.content.header')
    Dashboard
@endsection
@section('admin.content')
    <div class="row">

        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $postCount }}</h3>

                    <p>Posts</p>
                </div>
                <div class="icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <a href="{{ route('admin.post.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $categoryCount }}</h3>

                    <p>Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tag"></i>
                </div>
                <a href="{{ route('admin.category.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $tagCount }}</h3>

                    <p>Tags</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tags"></i>
                </div>
                <a href="{{ route('admin.tag.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $userCount }}</h3>

                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.user.index') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>




    </div>
@endsection
