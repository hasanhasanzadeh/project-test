@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                @php $row=0; @endphp
                @if(!$withdrawals->isEmpty())
                    <table class="w-full whitespace-no-wrap order border">
                        <thead>
                        <tr class="text-xs font-bold tracking-wide text-center text-gray-500  border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">ردیف</th>
                            <th class="px-4 py-3">درخواست دهنده</th>
                            <th class="px-4 py-3">@sortablelink('status', 'وضعیت')</th>
                            <th class="px-4 py-3">@sortablelink('amount', 'مبلغ')</th>
                            <th class="px-4 py-3">@sortablelink('paid_at', 'پرداخت کننده')</th>
                            <th class="px-4 py-3">@sortablelink('paid_at', 'تاریخ پرداخت')</th>
                            <th class="px-4 py-3">@sortablelink('created_at', 'تاریخ ایجاد درخواست')</th>
                            <th class="px-4 py-3">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                        @foreach($withdrawals as $withdrawal)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{++$row}}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{route('customers.show',$withdrawal->cardNumber->user_id)}}">
                                        @if($withdrawal->cardNumber->user->avatar)
                                            <img src="{{$withdrawal->cardNumber->user->avatar->address}}" height="90" width="90" class="rounded-full h-12 w-12 mx-auto" title="{{$withdrawal->cardNumber->user->fullNameWithGender}}" alt="{{$withdrawal->cardNumber->user->fullNameWithGender}}">
                                        @else
                                            <img src="{{url('/images/user/avatar-profile.png')}}" height="90" width="90" class="rounded-full h-12 w-12 mx-auto" title="{{$withdrawal->cardNumber->user->fullNameWithGender}}" alt="{{$withdrawal->cardNumber->user->fullNameWithGender}}">
                                        @endif
                                            <h4>{{$withdrawal->cardNumber->user->fullNameWithGender}}</h4>
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($withdrawal->status=='pending')
                                        <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-yellow-500 bg-yellow-200  last:mr-0 mr-1">
                                                {{__('dashboard.pending')}}
                                            </span>
                                    @elseif($withdrawal->status=='done')
                                        <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-green-600 bg-green-200  last:mr-0 mr-1">
                                                {{verta()->instance($withdrawal->paid_at)}}
                                            </span>
                                    @elseif($withdrawal->status=='fail')
                                        <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200  last:mr-0 mr-1">
                                                {{verta()->instance($withdrawal->paid_at)}}
                                            </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200  last:mr-0 mr-1">
                                        {{number_format($withdrawal->amount,0)}}
                                        <span> تومان </span>
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($withdrawal->admin_id)
                                        <a href="{{route('customers.show',$withdrawal->admin_id)}}">
                                            @if($withdrawal->admin->photo)
                                                <img src="{{$withdrawal->admin->photo->address}}" height="90" width="90" class="rounded-full h-12 w-12 mx-auto" title="{{$withdrawal->admin->fullNameWithGender}}" alt="{{$withdrawal->admin->fullNameWithGender}}">
                                            @else
                                                <img src="{{url('/images/user/avatar-profile.png')}}" height="90" width="90" class="rounded-full h-12 w-12 mx-auto" title="{{$withdrawal->admin->fullNameWithGender}}" alt="{{$withdrawal->admin->fullNameWithGender}}">
                                            @endif
                                            <h4>{{$withdrawal->admin->fullNameWithGender}}</h4>
                                        </a>
                                    @else
                                        @if($withdrawal->status=='pending')
                                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-yellow-500 bg-yellow-200  last:mr-0 mr-1">
                                                {{__('dashboard.pending')}}
                                            </span>
                                        @elseif($withdrawal->status=='done')
                                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-green-600 bg-green-200  last:mr-0 mr-1">
                                                {{verta()->instance($withdrawal->paid_at)->format('Y-m-d')}}
                                            </span>
                                        @elseif($withdrawal->status=='fail')
                                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200  last:mr-0 mr-1">
                                                {{verta()->instance($withdrawal->paid_at)->format('Y-m-d')}}
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                        @if($withdrawal->status=='pending')
                                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-yellow-500 bg-yellow-200  last:mr-0 mr-1">
                                                {{__('dashboard.pending')}}
                                            </span>
                                        @elseif($withdrawal->status=='done')
                                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-green-600 bg-green-200  last:mr-0 mr-1">
                                                {{verta()->instance($withdrawal->paid_at)->format('Y-m-d')}}
                                            </span>
                                        @elseif($withdrawal->status=='fail')
                                            <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200  last:mr-0 mr-1">
                                                {{verta()->instance($withdrawal->paid_at)->format('Y-m-d')}}
                                            </span>
                                        @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                        {{ verta()->instance($withdrawal->created_at)}}
                                </td>
                                <td class="px-4 py-3 ">
                                    <div class="text-xl flex justify-center">
                                        <a href="{{route('withdrawals.show',$withdrawal->id)}}" class="text-blue-500 mx-auto"
                                           title="show">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{route('customers.show',$withdrawal->cardNumber->user_id)}}" class="text-blue-500 mx-auto"
                                           title="Show">
                                            <i class="fa fa-user text-gray-600"></i>
                                        </a>
                                        @if($withdrawal->status=='pending')
                                            <a href="{{route('withdrawals.edit',$withdrawal->id)}}" class="text-yellow-500 mx-auto" title="Paid">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-4xl text-center text-gray-700 dark:text-gray-100">
                        رکوردی برای نمایش موجود نیست
                        <h2 class="text-center py-3 " id="smill">
                            <i class="far fa-grin-alt fa-3x"></i>
                        </h2>
                    </div>
                @endif
            </div>
            @if(!$withdrawals->isEmpty())
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500  border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  Number  {{$withdrawals->count()}}
                </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center px-4">
                        {!! $withdrawals->appends(Request::except('page'))->render() !!}
                    </ul>
                  </nav>
                </span>
                </div>
            @endif
        </div>
    </div>
@endsection
