@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <div class="w-full my-2">
            <form method="get" class="grid w-full">
                <div class="flex items-center text-center">
                    <input type="hidden" name="search" value="{{request('search')}}">
                    <div class="px-2 mx-2 flex items-center text-center">
                        <label for="from_date" class="dark:text-gray-200 text-gray-700 px-2 text-nowrap">از تاریخ :</label>
                        <input type="date" value="{{ request('from_date') ? \Carbon\Carbon::parse(request('from_date'))->format('Y-m-d'):''}}" name="from_date" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    <div class="px-2 mx-2 flex items-center text-center">
                        <label for="to_date" class="dark:text-gray-200 text-gray-700 px-2 text-nowrap">تا تاریخ :</label>
                        <input type="date" value="{{ request('to_date') ? \Carbon\Carbon::parse(request('to_date'))->format('Y-m-d'):''}}" name="to_date" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
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
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <div class="w-full overflow-x-auto">
                @if($referrals->count())
                    <table class="w-full  order">
                        <thead>
                        <tr class="text-sm font-bold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                            <th class="px-4 py-3">{{__('dashboard.row')}}</th>
                            <th class="px-4 py-3">{{__('dashboard.referral')}}</th>
                            <th class="px-4 py-3">{{__('dashboard.customer')}}</th>
                            <th class="px-4 py-3">{{__('dashboard.referral_code')}}</th>
                            <th class="px-4 py-3">@sortablelink('created_at', __('dashboard.created_at'))</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                        @foreach($referrals as $referral)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{$referral->id}}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <a href="{{route('customers.show',$referral->referral_id)}}" title="{{$referral->referredUser->full_name??$referral->referredUser->mobile}}">
                                        <img src="{{$referral->referredUser->avatar->address??asset('images/user/avatar-profile.png')}}" height="100" class="object-cover h-12 w-12 rounded-full shadow mx-auto" width="100" alt="{{$referral->referredUser->mobile}}">
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{route('customers.show',$referral->user_id)}}" title="{{$referral->user->mobile}}">
                                        <img src="{{$referral->user->avatar->address??asset('images/user/avatar-profile.png')}}" height="100" class="object-cover h-12 w-12 rounded-full shadow mx-auto" width="100" alt="{{$referral->user->mobile}}">
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                     <span class="text-xs font-semibold inline-block py-1 px-2 rounded text-emerald-600 bg-emerald-200 uppercase last:mr-0 mr-1">
                                            {{$referral->referredUser->referral_code}}
                                     </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{verta()->instance($referral->created_at)}}
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
            @if(!$referrals->isEmpty())
                <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                  {{__('dashboard.number')}}  {{$referrals->count()}}
                </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center px-4" dir="ltr">
                        {!! $referrals->appends(Request::except('page'))->render() !!}
                    </ul>
                  </nav>
                </span>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.show_confirm').click(function(e) {
            if(!confirm('{{__('dashboard.delete')}}')) {
                e.preventDefault();
            }
        });
    </script>
@endsection
