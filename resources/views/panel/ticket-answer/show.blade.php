@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('tickets.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            تیکت ها
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs" >
            <table class="w-full  order border">
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">شناسه تیکت</td>
                    <td class="px-4 py-3 text-sm">
                        {{$ticket->uid}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">عکس پروفایل</td>
                    <td class="px-4 py-3 text-sm flex justify-center">
                        <a href="{{route('customers.show',$ticket->user_id)}}" title="{{$ticket->user->first_name.' '.$ticket->user->last_name}}"> <img src="{{$ticket->user->avatar->address??asset('/images/user/avatar-profile.png')}}"  height="100" width="100" alt="" class=" rounded-full h-12 w-12 image-grayscale mx-auto"></a>
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">موضوع تیکت</td>
                    <td class="px-4 py-3 text-sm">
                        {{$ticket->subject}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">متن تیکت</td>
                    <td class="px-4 py-3 text-sm">
                        {!!$ticket->description!!}
                    </td>
                </tr>

                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">وضعیت تیکت</td>
                    <td class="px-4 py-3 text-sm">
                        @if($ticket->status=='open')
                            <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-green-600 bg-green-200  last:mr-0 mr-1">
                                           باز
                                        </span>
                        @elseif($ticket->status=='waiting')
                            <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-yellow-400 bg-yellow-200  last:mr-0 mr-1">
                                            منتظر پاسخ
                                        </span>
                        @elseif($ticket->status=='closed')
                            <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200  last:mr-0 mr-1">
                                            بسته
                                        </span>
                        @endif
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">تاریخ ایجاد تیکت</td>
                    <td class="px-4 py-3 text-sm">
                        {{verta($ticket->created_at)->formatDatetime()}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">تاریخ بستن تیکت</td>
                    <td class="px-4 py-3 text-sm">
                        @if($ticket->status=='closed')
                            {{verta($ticket->updated_at)->formatDatetime()}}
                        @elseif($ticket->status=='open')
                            <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-green-600 bg-green-200  last:mr-0 mr-1">
                                           باز
                                </span>
                        @elseif($ticket->status=='waiting')
                            <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-yellow-400 bg-yellow-200  last:mr-0 mr-1">
                                            منتظر پاسخ
                                </span>
                        @endif
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">فایل ضمیمه</td>
                    <td class="px-4 py-3 text-2xl">
                        @if($ticket->attach)
                            <a href="{{$ticket->attach->address}}" class="px-2 mx-auto"
                               title="Download">
                                <i class="fa fa-file-download text-blue-500"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
