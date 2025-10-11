@extends('errors.minimal')

@section('icon')
    <i class="fa-solid fa-user-lock"></i>
@endsection

@section('title', 'Unauthorized')
@section('code', '401')
@section('message', 'You are not authorized to access this page.')
