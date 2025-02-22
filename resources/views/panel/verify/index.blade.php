@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                @php $row=0;@endphp
                @if(!$customers->isEmpty())
                    <table class="w-full  order">
                        <thead>
                        <tr class="text-xm font-bold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                            <th class="px-4 py-3">{{__('dashboard.row')}}</th>
                            <th class="px-4 py-3">{{__('dashboard.photo')}}</th>
                            <th class="px-4 py-3">@sortablelink('full_name', __('dashboard.full_name'))</th>
                            <th class="px-4 py-3">@sortablelink('user_level', __('dashboard.user_level'))</th>
                            <th class="px-4 py-3">@sortablelink('authorize_file_status', 'عکس احراز هویت')</th>
                            <th class="px-4 py-3">@sortablelink('national_card_file_status', 'عکس کارت ملی')</th>
                            <th class="px-4 py-3">@sortablelink('created_at', __('dashboard.created_at'))</th>
                            <th class="px-4 py-3">{{__('dashboard.operation')}}</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                        @foreach($customers as $customer)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{++$row}}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($customer->avatar)
                                        <img src="{{$customer->avatar->address}}"  height="90" width="90" alt="" class="rounded-full w-12 h-12 mx-auto">
                                    @else
                                        <img src="{{asset('/images/user/avatar-profile.png')}}" height="90" width="90" alt="" class="rounded-full w-12 h-12 mx-auto">
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    {{$customer->full_name}}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                   <span class="text-xs font-semibold inline-block py-1 px-2 rounded uppercase text-blue-600 bg-blue-200 last:mr-0 mr-1">
                                            {{$customer->userLevel?$customer->userLevel->level_name:'سطح صفر'}}
                                   </span>
                                </td>
                                <td class="px-4 py-3 " dir="ltr">
                                    @if($customer->authorize_file_status=='accepted')
                                        <span class="font-semibold inline-block py-1 px-2 uppercase rounded text-emerald-600 bg-emerald-200 last:mr-0 mr-1">
                                            تایید شده
                                        </span>
                                    @elseif($customer->authorize_file_status=='rejected')
                                        <span class="font-semibold inline-block py-1 px-2 uppercase rounded text-red-600 bg-red-200 last:mr-0 mr-1">
                                            تایید نشده
                                        </span>
                                    @elseif($customer->authorize_file_status=='pending')
                                        <span class="font-semibold inline-block py-1 px-2 uppercase rounded text-yellow-600 bg-yellow-200 last:mr-0 mr-1">
                                            در انتظار تایید
                                        </span>
                                    @elseif($customer->authorize_file_status==null)
                                        <span class="font-semibold inline-block py-1 px-2 uppercase rounded text-yellow-600 bg-yellow-200 last:mr-0 mr-1">
                                            عکس احراز هویت ارسال نشده است
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm" dir="ltr">
                                        @if($customer->national_card_file_status=='accepted')
                                            <span class="font-semibold inline-block py-1 px-2 uppercase rounded text-emerald-600 bg-emerald-200 last:mr-0 mr-1">
                                            تایید شده
                                        </span>
                                        @elseif($customer->national_card_file_status=='rejected')
                                            <span class="font-semibold inline-block py-1 px-2 uppercase rounded text-red-600 bg-red-200 last:mr-0 mr-1">
                                            تایید نشده
                                        </span>
                                        @elseif($customer->national_card_file_status=='pending')
                                            <span class="font-semibold inline-block py-1 px-2 uppercase rounded text-yellow-600 bg-yellow-200 last:mr-0 mr-1">
                                            در انتظار تایید
                                        </span>
                                    @elseif($customer->national_card_file_status==null)
                                        <span class="font-semibold inline-block py-1 px-2 uppercase rounded text-yellow-600 bg-yellow-200 last:mr-0 mr-1">
                                            عکس کارت ملی ارسال نشده است
                                        </span>
                                        @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{verta()->instance($customer->created_at)}}
                                </td>
                                <td class="px-4 py-3">
                                   <div class="text-xl flex justify-center items-center">
                                       <a href="{{route('verifies.show',$customer->id)}}" class="text-blue-500 px-2 mx-auto" title="{{__('dashboard.show')}}">
                                           <i class="fa fa-eye"></i>
                                       </a>
                                       <a href="{{route('verifies.edit',$customer->id)}}" class="text-yellow-400 px-2 mx-auto" title="{{__('dashboard.edit')}}">
                                           <i class="fa fa-edit"></i>
                                       </a>
                                       <a href="{{ route('customers.show', $customer->id) }}" class="text-green-400 px-2 mx-auto" title="{{__('dashboard.permissions')}}">
                                           <i class="fa-solid fa-user-circle"></i>
                                       </a>
                                   </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-4xl text-center text-gray-700 dark:text-gray-100">
                        {{__('dashboard.showEmpty')}}
                        <h2 class="text-center py-3 text-6xl">
                            <i class="far fa-grin-alt"></i>
                        </h2>
                    </div>
                @endif
            </div>
            @if(!$customers->isEmpty())
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  {{__('dashboard.number')}}  {{$customers->count()}}
                </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center px-4" dir="ltr">
                        {!! $customers->appends(Request::except('page'))->links() !!}
                    </ul>
                  </nav>
                </span>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('.show_confirm').click(function(e) {
            if(!confirm('{{__('dashboard.areSureDelete')}}')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
