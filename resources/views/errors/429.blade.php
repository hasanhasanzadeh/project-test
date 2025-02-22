@extends('errors.error')

@section('image')
    <img src="{{asset('/images/errors/429.png')}}" alt="astronaut image">
@endsection

@section('title', __('Too Many Requests'))

@section('code', '429')

@section('message', __('Too Many Requests'))
