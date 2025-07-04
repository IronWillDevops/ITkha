@extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message',  $exception->getMessage() ?:'Payment Required')
