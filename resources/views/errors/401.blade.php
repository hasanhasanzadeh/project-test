@extends('errors.error')

@section('image')
    <img src="{{asset('/images/errors/401.png')}}" alt="astronaut image">
@endsection

@section('title', __('Unauthorized'))

@section('code', '401')

@section('message', __('Unauthorized'))
