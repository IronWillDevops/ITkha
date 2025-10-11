@extends('errors.minimal')

@section('icon')
  <i class="fa-solid fa-tools"></i>
@endsection

@section('code', '503')
@section('title', 'Service Unavailable')
@section('message', 'The server is temporarily unable to handle the request. Please try again later.')
