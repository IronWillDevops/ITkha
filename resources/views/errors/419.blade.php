@extends('errors.minimal')

@section('icon')
    <i class="fa-solid fa-clock"></i>
@endsection

@section('title', 'Page Expired')
@section('code', '419')
@section('message', 'The session has expired. Please refresh the page and try again.')
