@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('withdrawals.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            برداشت ها
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs" >
            <table class="w-full  order">
                <thead>
                <tr class="text-sm font-bold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                    <th class="px-4 py-3">{{__('dashboard.id')}}</th>
                    <th class="px-4 py-3">{{__('dashboard.description')}}</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.bank')}}</td>
                    <td class="px-4 py-3 text-xs">
                        <img src="{{$withdrawal->cardNumber->bank->photo->address??asset('images/no-image.png')}}"  height="150" width="150" alt="" class="rounded mx-auto object-cover h-20 w-20">
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">کاربر درخواست دهنده</td>
                    <td class="px-4 py-3 text-sm">
                        <a href="{{route('customers.show',$withdrawal->cardNumber->user_id)}}">
                            @if($withdrawal->cardNumber->user->avatar)
                                <img src="{{$withdrawal->cardNumber->user->avatar->address}}" height="150" width="150" class="rounded-full object-cover mx-auto w-20 h-20" title="{{$withdrawal->cardNumber->user->fullNameWithGender}}" alt="">
                            @else
                                <img src="{{url('/images/user/avatar-profile.png')}}" height="150" width="150" class="rounded-full mx-auto object-cover  w-20 h-20" title="{{$withdrawal->cardNumber->user->fullNameWithGender}}" alt="">
                            @endif
                        </a>
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">پرداخت کننده</td>
                    <td class="px-4 py-3 text-xs">
                        @if($withdrawal->admin)
                            <a href="{{route('customers.show',$withdrawal->admin_id)}}" title="{{$withdrawal->admin->fullNameWithGender}}">
                                @if($withdrawal->admin->photo)
                                    <img src="{{$withdrawal->admin->photo->address}}" height="150" width="150" class="rounded-full mx-auto object-cover h-20 w-20" title="{{$withdrawal->admin->fullNameWithGender}}" alt="">
                                @else
                                    <img src="{{url('/images/user/avatar-profile.png')}}" height="150" width="150" class="rounded-full mx-auto object-cover h-20 w-20" title="{{$withdrawal->admin->fullNameWithGender}}" alt="">
                                @endif
                            </a>
                        @else
                            @if($withdrawal->status=='done')
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.success')}}
                            </span>
                            @elseif($withdrawal->status=='fail')
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.fail')}}
                            </span>
                            @elseif($withdrawal->status=='pending')
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-yellow-600 bg-yellow-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.pending')}}
                            </span>
                            @endif
                        @endif
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.card_number')}}</td>
                    <td class="px-4 py-3 text-xs">
                        {{$withdrawal->cardNumber->card_number}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.card_shaba')}}</td>
                    <td class="px-4 py-3 text-medium">
                        {{$withdrawal->cardNumber->card_shaba}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">مبلغ درخواست شده</td>
                    <td class="px-4 py-3 text-medium">
                         <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200  last:mr-0 mr-1">
                              {{number_format($withdrawal->amount,0) }}
                             <span> تومان </span>
                          </span>
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.status')}}</td>
                    <td class="px-4 py-3 text-medium">
                        @if($withdrawal->status=='done')
                            <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.success')}}
                            </span>
                        @elseif($withdrawal->status=='fail')
                            <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.fail')}}
                            </span>
                        @elseif($withdrawal->status=='pending')
                            <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-yellow-600 bg-yellow-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.pending')}}
                            </span>
                        @endif
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">رسید پرداخت</td>
                    <td class="px-4 py-3 text-medium">
                        @if($withdrawal->photo)
                            <img src="{{route('private.images', ['filename' => str_replace('withdrawals/','',$withdrawal->photo->path)])}}"  height="140" width="140" alt="" class="image-grayscale mx-auto">
                        @else
                            <img src="{{asset('images/no-image.png')}}"  height="140" width="140" alt="" class="image-grayscale mx-auto">
                        @endif
                        <div class="m-4 p-2">
                            <a class="bg-green-700 px-5 py-2 text-medium shadow font-medium tracking-wider border border-green-500 hover:border-green-500 text-white rounded transition ease-in duration-300"  @if($withdrawal->photo) href="{{route('private.images', ['filename' => str_replace('withdrawals/','',$withdrawal->photo->path)])}}" download="{{ route('private.images', ['filename' => str_replace('withdrawals/','',$withdrawal->photo->path)])}}" @endif target="_blank">
                                <i class="fa fa-download"></i>
                                دانلود فاکتور
                            </a>
                        </div>
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">تاریخ پرداخت</td>
                    <td class="px-4 py-3 text-medium">
                        <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-yellow-600 bg-yellow-200 uppercase last:mr-0 mr-1">
                        {{$withdrawal->paid_at?verta()->instance($withdrawal->paid_at):'در انتظار'}}
                        </span>
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.created_at')}}</td>
                    <td class="px-4 py-3 text-medium">
                        {{verta()->instance($withdrawal->created_at)}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
