@extends('user.layouts.app_user')

@section('content')
        <div class="w-full my-2">
        <div class="p-2 m-2 md:flex md:justify-between md:items-center">
            <div class="px-2 mx-2">
                    <div class="flex items-center text-center">
                        <div class="px-2 mx-2">
                            <a href="{{route('notification.index')}}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ">
                                <i class="fa fa-list"></i>
                                <span>اعلانات</span>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
        <div class="w-full mx-auto z-10">
            <div class="flex flex-col">
                        <div class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                            <div class="flex justify-between p-2">
                                <div class="flex justify-center items-center dark:text-gray-200 text-gray-800">
                                    <a href="{{route('notification.show',$notification->id)}}">
                                        <h6>اعلان جدید </h6>
                                        <h4 class="px-4">{{$notification->subject}}</h4>
                                    </a>
                                </div>
                                <div class="flex justify-center items-center dark:text-gray-200 text-gray-800">
                                    <div>
                                        <i class="fa fa-clock px-1"></i>
                                        <span class="px-1">{{verta($notification->created_at)->format('Y-m-d (H:i)')}}</span>
                                    </div>
                                    <div>
                                        <form action="{{route('notification.delete')}}" method="POST" class="px-4">
                                            @csrf
                                            <input type="hidden" value="{{$notification->id}}" name="id">
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold h-8 w-8 rounded-full ">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="items-center dark:text-gray-200 text-gray-800 p-4">
                                {!!$notification->description!!}
                            </div>
                        </div>
                    </div>
                </div>

@endsection
