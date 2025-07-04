@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', 'Authentication is required to access the resource.')
