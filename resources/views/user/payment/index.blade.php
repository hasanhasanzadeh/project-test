@extends('user.layouts.app_user')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('payment.show')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-add"></i>
            <span>شارژ کیف پول</span>
        </a>
        <div class="w-full">
            <form method="get" class="grid w-full">
                <div class="flex items-center text-center">
                    <div class="px-2 mx-2 flex items-center text-center">
                        <label for="datepicker" class="dark:text-gray-200 text-gray-700 px-2 text-nowrap">از تاریخ :</label>
                        <input type="text" id="datepicker" name="from_date" class="datepicker appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    <div class="px-2 mx-2 flex items-center text-center">
                        <label for="datepicker" class="dark:text-gray-200 text-gray-700 px-2 text-nowrap">از تاریخ :</label>
                        <input type="text" id="datepicker" name="to_date" class="datepicker appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-14 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    <div class="px-2 mx-2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">
                            <i class="fa fa-filter"></i>
                            فیلتر
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="w-full mx-auto z-10">
            <div class="flex flex-col">
                <div class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 my-4">
                    @if($user->userLevel)
                        <div class="flex justify-between items-center dark:text-gray-200 text-gray-800">
                            @php
                                $total = $user->userLevel->maximum_deposit - \App\Helpers\Helper::todayDeposit($user->id);
                            @endphp
                            <div class="text-xl">
                                <span>
                                    سقف واریز روزانه شما :
                                </span>
                                <span class="text-green-600">
                                    {{number_format($user->userLevel->maximum_deposit,0) .' تومان '}}
                                </span>
                            </div>
                            <div class="text-xl">
                                <span>سقف واریز مانده امروز :</span>
                                <span class="text-red-600">
                                {{number_format($total,0).' تومان '}}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-between items-center dark:text-gray-200 text-gray-800">
                            <div class="text-xl">
                                <span>
                                    لطفا سطح کاربری خود را ارتقاء دهید
                                </span>
                            </div>
                            <div class="text-xl">
                                <a href="{{route('level.show')}}"  class="flex-no-shrink bg-green-600 hover:bg-green-700 px-5 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-500 hover:border-green-500 text-white rounded-full transition ease-in duration-300">
                                    ارتقاء سطح کاربری
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                @php $row=0;@endphp
                @if(!$payments->isEmpty())
                    <table class="w-full  order">
                        <thead>
                        <tr class="text-sm font-bold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                            <th class="px-4 py-3">{{__('dashboard.row')}}</th>
                            <th class="px-4 py-3">{{__('dashboard.bank')}}</th>
                            <th class="px-4 py-3">شماره تراکنش</th>
                            <th class="px-4 py-3">@sortablelink('card_number', __('dashboard.card_number'))</th>
                            <th class="px-4 py-3">@sortablelink('amount', __('dashboard.amount'))</th>
                            <th class="px-4 py-3">@sortablelink('payment_amount', 'مبلغ پرداخت با مالیات' )</th>
                            <th class="px-4 py-3">@sortablelink('status', __('dashboard.status'))</th>
                            <th class="px-4 py-3">@sortablelink('created_at', __('dashboard.created_at'))</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                        @foreach($payments as $payment)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{++$row}}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @if($payment->cardNumber)
                                        <img src="{{$payment->cardNumber->bank->photo->address??''}}"  height="100" width="100" alt="" class="mx-auto h-20 w-20 object-cover">
                                    @else
                                        <img src="{{asset('/images/no-image.png')}}"  height="100" width="100" alt="" class="mx-auto h-20 w-20 object-cover">
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-medium">
                                    {{$payment->ref_num}}
                                </td>
                                <td class="px-4 py-3 text-medium">
                                    {{$payment->cardNumber->card_number}}
                                </td>
                                <td class="px-4 py-3 text-medium">
                                    <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                                    {{ number_format($payment->amount/10,0).' تومان '}}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-medium">
                                    <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-green-600 bg-green-200 uppercase last:mr-0 mr-1">
                                    {{ number_format($payment->payment_amount/10,0).' تومان '}}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @if($payment->status=='completed')
                                        <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.success')}}
                                        </span>
                                    @elseif($payment->status=='failed')
                                        <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.fail')}}
                                        </span>
                                    @elseif($payment->status=='pending')
                                        <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                                            {{__('dashboard.pending')}}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{verta()->instance($payment->created_at)}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            @if(!$payments->isEmpty())
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  {{__('dashboard.number')}}  {{$payments->count()}}
                </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center px-4" >
                        {!! $payments->appends(Request::except('page'))->render() !!}
                    </ul>
                  </nav>
                </span>
                </div>
            @endif
        </div>
    </div>
@endsection
