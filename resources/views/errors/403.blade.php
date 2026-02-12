@extends('errors.minimal')

@section('icon')
    <i class="fa-solid fa-ban"></i>
@endsection

@section('title', 'Forbidden')
@section('code', '403')
@section('message',  $exception->getMessage() ?? 'You do not have permission to view this page.')
