@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semi bold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('withdrawals.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
           برداشت ها
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs" >
            <div class="text-center">
                <a href="{{route('customers.show',$withdrawal->cardNumber->user_id)}}" title="{{$withdrawal->cardNumber->user->fullName}}">
                    @if($withdrawal->cardNumber->user->avatar)
                        <img src="{{$withdrawal->cardNumber->user->avatar->address}}" class="rounded-full mx-auto shadow w-14 h-14" alt="{{$withdrawal->cardNumber->user->fullNameWithGender}}" >
                    @else
                        <img src="{{url('/images/user/avatar-profile.png')}}" class="rounded-full mx-auto shadow w-14 h-14" alt="{{$withdrawal->cardNumber->user->fullNameWithGender}}" >
                    @endif
                </a>
                    <h4 class="p-3">
                    <span>نام و نام خانوادگی:</span>
                        {{$withdrawal->cardNumber->user->fullNameWithGender}}
                    </h4>
                    <h4 class="p-3">
                    <span>شماره موبایل:</span>
                        <span class="text-left" dir="ltr">{{$withdrawal->cardNumber->user->mobile}}</span>
                    </h4>
                    <h4 class="p-3">
                        <span> شماره ایمیل:</span>
                         <span class="text-left" dir="ltr">{{$withdrawal->cardNumber->user->email}}</span>
                    </h4>
            </div>
            <div class="w-full overflow-x-auto">
                <form class="w-full" method="post" action="{{route('withdrawals.update',$withdrawal->id)}}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PATCH')}}
                    <div class="flex flex-wrap mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="flex justify-between tracking-wide text-gray-700 text-xs font-bold mb-2" for="amount">
                                مبلغ درخواست دهنده
                                <span class="amount"></span>
                            </label>
                            <input type="number" disabled name="amount" readonly  value="{{$withdrawal->amount}}" id="amount" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 pr-8 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-input text-right" >
                        </div>
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="block  tracking-wide text-gray-700 text-xs font-bold mb-2" for="status">
                                وضعیت درخواست
                            </label>
                            <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded pr-10 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="status" name="status" >
                                <option value="pending" @if($withdrawal->status=='pending') selected @endif > {{__('dashboard.pending')}} </option>
                                <option value="done" @if($withdrawal->status=='done') selected @endif >{{__('dashboard.success')}}</option>
                                <option value="fail" @if($withdrawal->status=='fail') selected @endif >{{__('dashboard.fail')}}</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="block  tracking-wide text-gray-700 text-xs font-bold mb-2" for="image">
                               فاکتور درخواست
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="image" name="image" type="file" placeholder="Image Select">
                            <img src="" id="image-select" alt="" class="object-cover shadow rounded hidden" width="150" height="150">
                        </div>
                        <div class="w-full md:w-1/2 px-3 my-3">
                            <label class="block  tracking-wide text-gray-700 text-xs font-bold mb-2" for="datepicker">
                                تاریخ انجام درخواست
                            </label>
                            <input type="text" id="datepicker"  class="datepicker appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-3 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="paid_at" >
                        </div>
                        <div class="w-full px-3 my-3">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                <i class="fa fa-save"></i>
                                ویرایش
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
        $("#image").change(function (e) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-select').attr('src', e.target.result);
                    $('#image-select').removeClass('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        window.onload = function() {
            let price=Num2persian($('#amount').val())+" تومان ";
            $('.amount').html(price);
        };
    </script>
@endsection
