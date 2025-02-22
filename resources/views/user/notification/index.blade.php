@extends('user.layouts.app_user')

@section('content')
        <div class="w-full my-2">
        <div class="p-2 m-2 md:flex md:justify-between md:items-center">
            <div class="px-2 mx-2">
                <form method="POST" action="{{route('notification.read')}}" class="grid w-full">
                    @csrf
                    <div class="flex items-center text-center">
                        <div class="px-2 mx-2">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ">
                                <i class="fa-regular fa-circle-check"></i>
                                <span>خواندن همه</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="px-2 mx-2">
                <form method="POST" action="{{route('notification.deleteAll')}}" class="grid w-full">
                    @csrf
                    <div class="flex items-center text-center">
                        <div class="px-2 mx-2">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">
                                <i class="fa fa-delete-left"></i>
                                <span>پاک کردن همه</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        @if(!$notifications->isEmpty())
            @foreach($notifications as $notification)
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
                                        <a href="{{route('notification.show',$notification->id)}}">
                                            <i class="fa fa-clock px-1"></i>
                                            <span class="px-1">{{verta($notification->created_at)->format('Y-m-d (H:i)')}}</span>
                                        </a>
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
                                    @if(!$notification->read_at)
                                        <div title="خوانده نشده">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    @else
                                        <div title="خوانده شده">
                                            <i class="fa fa-check-circle text-green-500"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="w-full mx-auto z-10">
                <div class="flex flex-col">
                    <div class="text-center bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                        <span class="px-4 text-gray-700 dark:text-gray-200 bold h2">اعلانی جهت نمایش موجود نیست</span>
                    </div>
                </div>
            </div>
        @endif

    @if(!$notifications->isEmpty())
            <div class="grid px-4 py-8 text-xs font-semibold tracking-wide text-gray-500  border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  Number  {{$notifications->count()}}
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center px-4" >
                        {!! $notifications->appends(Request::except('page'))->render() !!}
                    </ul>
                  </nav>
                </span>
            </div>
    @endif

@endsection
