@extends('errors.error')

@section('image')
    <img src="{{asset('/images/errors/404.svg')}}" alt="astronaut image">
@endsection

@section('title', __('Not Found'))

@section('code', '404')

@section('message', __('Not Found'))

