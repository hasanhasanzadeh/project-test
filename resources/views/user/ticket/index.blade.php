@extends('user.layouts.app_user')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <div class="w-full my-2">
            <div class="p-2 m-2 md:flex md:justify-between md:items-center">
                <div class="px-2 mx-2">
                    <form method="get" class="grid w-full">
                        <div class="flex items-center text-center">
                            <input type="hidden" name="search" value="{{request('search')}}">
                            <div class="px-2 mx-2 flex items-center text-center">
                                <label for="status" class="dark:text-gray-200 text-gray-700 px-2 text-nowrap">وضعیت تیکت:</label>
                                <select name="status" id="status" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="" @if(!request('status')) selected @endif>وضعیت را انتخاب کنید</option>
                                    <option value="open" @if(request('status')=='open') selected @endif>باز</option>
                                    <option value="waiting" @if(request('status')=='waiting') selected @endif>منتظر پاسخ</option>
                                    <option value="closed" @if(request('status')=='closed') selected @endif>بسته شده</option>
                                </select>
                            </div>
                            <div class="px-2 mx-2">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">
                                    <i class="fa fa-filter"></i>
                                    فیلتر
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="px-2 mx-2">
                    <a href="{{route('ticket.add')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
                        <i class="fa fa-plus"></i>
                        ایجاد تیکت جدید
                    </a>
                </div>
            </div>
        </div>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                @if(!$tickets->isEmpty())
                    <table class="w-full  order border">
                        <thead>
                        <tr class="text-xs font-bold tracking-wide text-center text-gray-500  border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
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
                                    <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-green-600 bg-green-200  last:mr-0 mr-1">
                                            {{ $ticket->sectionLabel}}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{route('answer.show',$ticket->id)}}" class="hover:underline hover:text-blue-500">
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
                                            <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-blue-700 bg-blue-300  last:mr-0 mr-1">
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
                                    <span class="text-sm font-semibold inline-block py-1 px-2 rounded text-blue-500 bg-blue-200  last:mr-0 mr-1">
                                            {{ $ticket->importanceLabel}}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ verta($ticket->updated_at)->formatDatetime()}}
                                </td>
                                <td class="px-4 py-3 text-xl flex justify-center">
                                        <a href="{{route('answer.show',$ticket->id)}}" class="mx-2" title="نمایش یا پاسخ تیکت">
                                                <i class="fa fa-envelope-open-text text-blue-500"></i>
                                        </a>
                                    @if($ticket->status!='closed')
                                        <a href="{{route('ticket.close',$ticket->id)}}" class="mx-2" title="بستن تیکت">
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
