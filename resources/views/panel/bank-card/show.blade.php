@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('bank-cards.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            <span>حساب های بانکی</span>
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <table class="w-full  order">
                <thead>
                <tr class="text-sm font-bold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                    <th class="px-4 py-3">{{__('dashboard.id')}}</th>
                    <th class="px-4 py-3">{{__('dashboard.description')}}</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.id')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$bankCard->id}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.photo')}}</td>
                    <td class="px-4 py-3 text-sm">
                        <a href="{{route('customers.show',$bankCard->user_id)}}" title="{{$bankCard->user->full_name}}"> <img src="{{$bankCard->user->photo->address??asset('/images/user/avatar-profile.png')}}"  height="140" width="100" alt="" class="image-grayscale mx-auto"></a>
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">اطلاعات کاربری</td>
                    <td class="px-4 py-3">
                        <h4 class="p-3">{{$bankCard->user->full_name}}</h4>
                        <h4 class="p-3">{{$bankCard->user->mobile}}</h4>
                        <h4 class="p-3">{{$bankCard->user->national_code}}</h4>
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.card_number')}}</td>
                    <td class="px-4 py-3 ">
                        {{$bankCard->card_number}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.card_shaba')}}</td>
                    <td class="px-4 py-3">
                        {{$bankCard->card_shaba}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.status')}}</td>
                    <td class="px-4 py-3 ">
                        @if($bankCard->status=='active')
                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.active')}}
                            </span>
                        @elseif($bankCard->status=='inactive')
                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.inactive')}}
                            </span>
                        @elseif($bankCard->status=='pending')
                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-yellow-600 bg-yellow-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.pending')}}
                            </span>
                        @endif
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.created_at')}}</td>
                    <td class="px-4 py-3 text-sm">
                            {{verta()->instance($bankCard->created_at)}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
