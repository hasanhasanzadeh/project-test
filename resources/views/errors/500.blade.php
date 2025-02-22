@extends('errors.error')

@section('image')
    <img src="{{asset('/images/errors/500.png')}}" alt="astronaut image">
@endsection

@section('title', __('Server Error'))

@section('code', '500')

@section('message', __('Server Error'))
