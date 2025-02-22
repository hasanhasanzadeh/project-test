@extends('user.layouts.app_user')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semi bold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('withdrawal.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            <span>برداشت از حساب</span>
        </a>
        <div class="w-full mx-auto z-10">
            <div class="flex flex-col">
                <div class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-900 shadow-lg  rounded-3xl p-4 my-4">
                    @if($user->userLevel)
                        <div class="flex justify-between items-center dark:text-gray-200 text-gray-800">
                            @php
                                $total = $user->userLevel->maximum_withdrawal - \App\Helpers\Helper::todayWithdrawal($user->id);
                            @endphp
                            <div class="text-xl">
                                <span>
                                    سقف برداشت روزانه شما :
                                </span>
                                <span class="text-green-600">
                                    {{number_format($user->userLevel->maximum_withdrawal,0) .' تومان '}}
                                </span>
                            </div>
                            <div class="text-xl">
                                <span>سقف برداشت مانده امروز :</span>
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
        <div class="w-full overflow-hidden rounded-lg shadow-xs border p-5 m-2" >
            <div class="w-full overflow-x-auto">
                <form class="w-full" method="post" action="{{route('withdrawal.store')}}" >
                    @csrf
                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full px-3">
                            <div class="mb-5">
                                <label for="full_name" class="flex justify-between mb-3 dark:text-gray-200 text-gray-800 text-base font-medium">
                                            <span>
                                                مبلغ برداشت را وارد کنید
                                            (مبلغ را به تومان وارد کنید)
                                                <button type="button" id="get-balance" class="hover:shadow-form rounded-md bg-blue-600 p-2 text-center text-base font-semibold text-white outline-none">انتخاب کل مبلغ کیف پول</button>
                                            </span>
                                    <span class="amount font-bold mb-2 dark:text-gray-50"></span>
                                </label>

                                <input
                                    type="text"
                                    name="amount"
                                    id="amount"
                                    min="1000"
                                    max="24000000"
                                    maxlength="8"
                                    placeholder="مبلغ شارژ را وارد کنید"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                />
                            </div>
                        </div>
                        <div class="w-full px-3">
                            <div class="mb-5">
                                <label for="card_number" class="flex justify-between mb-3 dark:text-gray-200 text-gray-800 text-base font-medium">
                                            <span>
                                               انتخاب کارت
                                            </span>
                                    <a href="{{route('cards.create')}}" class="hover:shadow-form rounded-md bg-green-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                        ثبت شماره کارت
                                    </a>
                                </label>
                                <select name="card_number_id" id="card_number" class="pr-9 w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md">
                                    @foreach(App\Models\BankCard::where('status','active')->where('user_id',auth()->user()->id)->get() as $card)
                                        <option value="{{$card->id}}">
                                            {{'  -  بانک : '.$card->bank->name.' -  شماره کارت : '.$card->card_number}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-full px-3 my-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fa fa-save"></i>
                                {{__('dashboard.store')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{url('/js/numtopersian.min.js')}}"></script>
    <script>
        $('body').on('keyup', '#amount', function() {
            let price=Num2persian($(this).val())+" تومان ";
            $('.amount').html(price);
        });
        $('#get-balance').on('click',function (){
           $('#amount').val({{$user->balance}});
            let price=Num2persian({{$user->balance}})+" تومان ";
            $('.amount').html(price);
        });
    </script>
@endsection
