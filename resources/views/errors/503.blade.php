@extends('errors.error')

@section('image')
    <img src="{{asset('/images/errors/503.svg')}}" alt="astronaut image">
@endsection

@section('title', __('Service Unavailable'))

@section('code', '503')

@section('message', __('Service Unavailable'))
