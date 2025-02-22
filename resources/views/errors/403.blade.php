@extends('errors.error')

@section('image')
    <img src="{{asset('/images/errors/403.png')}}" alt="astronaut image">
    <h4 class="text-gray-100 h3 text-center p-2 m-1 bg-red-600 rounded shadow-lg">
        در صورت روشن بودن وی پی ان لطفا آن را خاموش کنید چون دسترسی فقط از ایران امکان پذیر است
    </h4>
@endsection

@section('title', __('Forbidden'))

@section('code', '403')

@section('message', __($exception->getMessage() ?: 'Forbidden'))
