@extends('panel.layouts.app')

@section('content')
    <div class="container px-6 mx-auto grid">
        <span class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{$title}}
        </span>
        <a href="{{route('customers.index')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-auto">
            <i class="fa fa-list"></i>
            {{__('dashboard.customers')}}
        </a>
        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs border" >
            <table class="w-full  order">
                <thead>
                <tr class="text-sm font-bold tracking-wide text-center text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800" >
                    <th class="px-4 py-3">{{__('dashboard.id')}}</th>
                    <th class="px-4 py-3">{{__('dashboard.photo')}}</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-center">
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.photo')}}</td>
                        <td class="px-4 py-3 text-medium">
                            @if($customer->avatar)
                                <img src="{{$customer->avatar->address}}"  height="90" width="90"  class="rounded-full w-12 h-12 mx-auto" alt="">
                            @else
                                <img src="{{url('/images/user/avatar-profile.png')}}" height="90" width="90" alt="" class="rounded-full mx-auto">
                            @endif
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.full_name')}}</td>
                        <td class="px-4 py-3 text-medium">
                            {{$customer->full_name}}
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.gender')}}</td>
                        <td class="px-4 py-3 text-medium">
                            @if($customer->gender=='female')
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-red-200 uppercase last:mr-0 mr-1">
                                    خانم
                                </span>
                            @elseif($customer->gender='male')
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                                    آقا
                                </span>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.national_code')}}</td>
                        <td class="px-4 py-3 text-medium">
                            <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                             {{$customer->national_code}}
                            </span>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.father_name')}}</td>
                        <td class="px-4 py-3 text-medium">
                            <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                             {{$customer->father_name}}
                            </span>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.block')}}</td>
                        <td class="px-4 py-3 text-medium">
                            @if($customer->block)
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                                 {{$customer->blockLabel}}
                                </span>
                            @else
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                                 {{$customer->blockLabel}}
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.birthday')}}</td>
                        <td class="px-4 py-3 text-medium">
                            <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                             {{$customer->birthday?verta($customer->birthday)->format('Y/m/d'):'-'}}
                            </span>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.email_verified_at')}}</td>
                        <td class="px-4 py-3 text-medium">
                            @if($customer->email_verified_at)
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                                    {{verta($customer->email_verified_at)->format('Y-m-d H:i:s')}}
                                </span>
                            @else
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-red-600 bg-red-200 uppercase last:mr-0 mr-1">
                                    تایید نشده
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.level')}}</td>
                        <td class="px-4 py-3 text-medium">
                            <span class="text-medium font-semibold inline-block py-1 px-2 rounded uppercase text-blue-600 bg-blue-200 last:mr-0 mr-1">
                                {{$customer->level}}
                            </span>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.userLevel')}}</td>
                        <td class="px-4 py-3 text-medium">
                            @if($customer->userLevel)
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded uppercase text-blue-600 bg-blue-200 last:mr-0 mr-1">
                                    {{$customer->userLevel->title}}
                                </span>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.referral_code')}}</td>
                        <td class="px-4 py-3 text-medium" >
                                <button id="copyButton" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2">
                                    کپی
                                </button>
                                <span id="copyText" class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 last:mr-0 mr-1">
                                    {{url('/register?referral_code='.$customer->referral_code)}}
                                </span>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">وضعیت فعالیت دسترسی</td>
                        <td class="px-4 py-3 text-medium">
                            @if($customer->status)
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded uppercase text-blue-600 bg-blue-200 last:mr-0 mr-1">
                                    {{$customer->statusLabel}}
                                </span>
                            @else
                                <span class="text-medium font-semibold inline-block py-1 px-2 rounded uppercase text-red-600 bg-red-200 last:mr-0 mr-1">
                                    {{$customer->statusLabel}}
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.mobile')}}</td>
                        <td class="px-4 py-3 text-medium" dir="ltr">
                            {{$customer->mobile}}
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.email')}}</td>
                        <td class="px-4 py-3 text-medium">
                            {{$customer->email}}
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.wallet')}}</td>
                        <td class="px-4 py-3 text-xs">
                            <span class="text-medium font-semibold inline-block py-1 px-2 rounded text-blue-600 bg-blue-200 uppercase last:mr-0 mr-1">
                                  {{number_format($customer->balance,0).' '.__('dashboard.iran_rial')}}
                            </span>
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.address')}}</td>
                        <td class="px-4 py-3 text-medium">
                            {{$customer->address}}
                        </td>
                    </tr>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">{{__('dashboard.created_at')}}</td>
                        <td class="px-4 py-3 text-sm">
                            @if(config('app.locale')=='fa')
                                {{verta()->instance($customer->created_at)->format('%d %B %Y')}}
                            @else
                                {{ date('d-M-y', strtotime($customer->created_at))}}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('copyButton').addEventListener('click', function() {
            // Get the text from the paragraph element
            let copyText = document.getElementById('copyText').innerText;

            // Copy the text to the clipboard
            navigator.clipboard.writeText(copyText).then(() => {
                Swal.fire({
                    toast: false,
                    position: 'center',
                    icon: 'success',
                    title: "لینک معرف کپی شد " ,
                    showConfirmButton: false,
                    timer: 3000
                });
            }).catch(err => {
                Swal.fire({
                    toast: false,
                    position: 'center',
                    icon: 'success',
                    title: "لینک معرف کپی شد " ,
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        });
    </script>
@endsection

