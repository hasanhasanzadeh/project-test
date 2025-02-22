@extends('errors.error')

@section('image')
    <img src="{{asset('/images/errors/419.png')}}" alt="astronaut image">
@endsection

@section('title', __('Page Expired'))

@section('code', '419')

@section('message', __('Page Expired'))
