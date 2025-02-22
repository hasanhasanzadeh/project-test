@extends('errors.error')

@section('image')
    <img src="{{asset('/images/errors/402.png')}}" alt="astronaut image">
@endsection

@section('title', __('Payment Required'))

@section('code', '402')

@section('message', __('Payment Required'))

