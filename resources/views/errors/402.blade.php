@extends('errors.minimal')

@section('icon')
    <i class="fa-solid fa-credit-card"></i>
@endsection

@section('title', 'Payment Required')
@section('code', '402')
@section('message', 'Payment is required to access this content.')
