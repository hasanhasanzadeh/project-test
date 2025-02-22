@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <div class="w-full my-2">
            <div class="p-2 m-2 md:items-center">
                <div class="px-2 mx-2">
                    <form method="get" class="grid w-full">
                        <div class="flex items-center text-center">
                            <input type="hidden" name="search" value="{{request('search')}}">
                            <div class="w-full px-3 sm:w-1/5">
                                <div class="mb-5">
                                    <label
                                        for="status"
                                        class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                    >
                                        وضعیت
                                    </label>
                                    <select name="status" id="status" dir="ltr" class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md" >
                                        <option value="" @if(!request('status')) selected @endif>وضعیت را انتخاب کنید</option>
                                        <option value="open" @if(request('status')=='open') selected @endif>باز</option>
                                        <option value="waiting" @if(request('status')=='waiting') selected @endif>منتظر پاسخ</option>
                                        <option value="closed" @if(request('status')=='closed') selected @endif>بسته شده</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full px-3 sm:w-1/5">
                                <div class="mb-5">
                                    <label
                                        for="section"
                                        class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                    >
                                        بخش
                                    </label>
                                    <select name="section" id="section" dir="ltr" class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md" >
                                        <option value="" @if(!request('section')) selected @endif>بخش تیکت را انتخاب کنید</option>
                                        <option value="technical_unit" @if(request('section')=='technical_unit') selected @endif>واحد فنی</option>
                                        <option value="financial_unit" @if(request('section')=='financial_unit') selected @endif>واحد مالی</option>
                                        <option value="management_unit" @if(request('section')=='management_unit') selected @endif>واحد مدیریت</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full px-3 sm:w-1/5">
                                <div class="mb-5">
                                    <label
                                        for="importance"
                                        class="mb-3 block dark:text-gray-200 text-gray-800 text-base font-medium"
                                    >
                                        اهمیت
                                    </label>
                                    <select name="importance" dir="ltr" id="importance" class="w-full rounded-md border border-[#e0e0e0] bg-white dark:bg-gray-600 py-3 px-6 text-base font-medium text-gray-800 dark:text-gray-200 outline-none focus:border-[#6A64F1] focus:shadow-md" >
                                        <option value="" @if(!request('importance')) selected @endif> نوع اهمیت تیکت را انتخاب کنید</option>
                                        <option value="ordinary" @if(request('importance')=='ordinary') selected @endif>معمولی</option>
                                        <option value="important" @if(request('importance')=='important') selected @endif>مهم</option>
                                        <option value="necessary" @if(request('importance')=='necessary') selected @endif>ضروری</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full px-3 sm:w-1/5">
                                <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ">
                                    <i class="fa fa-filter"></i>
                                    فیلتر
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                @php $row=0; @endphp
                @if(!$tickets->isEmpty())
                    <table class="w-full  order border">
                        <thead>
                        <tr class="text-xs font-bold tracking-wide text-center text-gray-500  border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">ردیف</th>
                            <th class="px-4 py-3">کاربر</th>
                            <th class="px-4 py-3">@sortablelink('section', 'بخش تیکت')</th>
                            <th class="px-4 py-3">@sortablelink('subject', 'موضوع تیکت')</th>
                            <th class="px-4 py-3">@sortablelink('status', 'وضعیت تیکت')</th>
                            <th class="px-4 py-3">@sortablelink('importance', 'اهمیت تیکت')</th>
                            <th class="px-4 py-3">@sortablelink('updated_at', 'اخرین بروز رسانی تیکت')</th>
                            <th class="px-4 py-3">عملیات</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                        @foreach($tickets as $ticket)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{++$row}}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                        <a href="{{route('customers.show',$ticket->user_id)}}">
                                            <img src="{{$ticket->user->avatar->address??asset('/images/user/avatar-profile.png')}}" class="rounded-full h-12 w-12" height="80" width="80" title="{{$ticket->user->email}}" alt="{{$ticket->user->last_name}}">
                                        </a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-green-600 bg-green-200  last:mr-0 mr-1">
                                            {{ $ticket->sectionLabel}}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{route('answers.create',$ticket->id)}}" class="hover:underline hover:text-blue-600">
                                        <span class="block text-blue-400">#{{$ticket->uid}}</span>
                                        <span class="block">{{$ticket->subject}}</span>
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{route('answer.show',$ticket->id)}}">
                                        @if($ticket->status=='open')
                                            <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-green-600 bg-green-200  last:mr-0 mr-1">
                                            باز
                                        </span>
                                        @elseif($ticket->status=='waiting')
                                            <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-yellow-700 bg-yellow-300  last:mr-0 mr-1">
                                            منتظر پاسخ
                                        </span>
                                        @elseif($ticket->status=='closed')
                                            <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-red-700 bg-red-200  last:mr-0 mr-1">
                                             بسته
                                        </span>
                                        @endif
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200  last:mr-0 mr-1">
                                            {{ $ticket->importanceLabel}}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ verta($ticket->updated_at)->formatDatetime()}}
                                </td>
                                <td class="px-4 py-3 text-xl flex justify-center">
                                    <a href="{{route('tickets.show',$ticket->id)}}" class="mx-2" title="نمایش تیکت">
                                            <i class="fa fa-eye text-blue-500"></i>
                                    </a>
                                        <a href="{{route('answers.create',$ticket->id)}}" class="mx-2" title="ایجاد پاسخ">
                                                <i class="fa fa-envelope-open-text text-blue-500"></i>
                                        </a>
                                    @if($ticket->status!='closed')
                                        <a href="{{route('tickets.close',$ticket->id)}}" class="mx-2" title="بستن تیکت">
                                            <i class="fa fa-close text-red-600 fa-xl"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-4xl text-center text-gray-700 dark:text-gray-100">
                        {{__('dashboard.showEmpty')}}
                        <h2 class="text-center py-3 " id="smill">
                            <i class="far fa-grin-alt fa-3x"></i>
                        </h2>
                    </div>
                @endif
            </div>
            @if(!$tickets->isEmpty())
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500  border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  Number  {{$tickets->count()}}
                </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center px-4" dir="ltr">
                        {!! $tickets->appends(Request::except('page'))->render() !!}
                    </ul>
                  </nav>
                </span>
                </div>
            @endif
        </div>
    </div>
@endsection
