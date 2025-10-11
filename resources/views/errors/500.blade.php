@extends('errors.minimal')

@section('icon')
    <i class="fa-solid fa-server"></i>
@endsection

@section('title', 'Internal Server Error')
@section('code', '500')
@section('message', 'An internal server error has occurred.')
