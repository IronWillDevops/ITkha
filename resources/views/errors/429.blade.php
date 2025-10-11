@extends('errors.minimal')

@section('icon')
    <i class="fa-solid fa-exclamation-triangle"></i>
@endsection

@section('title', 'Too Many Requests')
@section('code', '429')
@section('message',  'You have sent too many requests. Please try again later.')
