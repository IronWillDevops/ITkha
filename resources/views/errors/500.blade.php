@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message',  $exception->getMessage() ?:'The server encountered an unexpected condition.')
