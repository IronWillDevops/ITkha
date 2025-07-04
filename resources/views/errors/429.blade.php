@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message',  $exception->getMessage() ?:'Too many requests in a short period (rate limit exceeded).')
