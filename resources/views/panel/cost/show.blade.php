@extends('panel.layouts.app')

@section('content')
    <div class="w-full mx-auto z-10">
        <div class="flex flex-col">
            <div class="dark:bg-gray-700 border dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                <div class="flex-none sm:flex gap-4">
                    <div class=" relative h-32 w-32  sm:mb-0 mb-3">
                        @if($user->avatar)
                            <img src="{{$user->avatar->address}}" alt="{{$user->name}}" class=" w-32 h-32 object-cover rounded-2xl">
                        @else
                            <img src="{{asset('/images/user/avatar-profile.png')}}" alt="avatar default" class=" w-32 h-32 object-cover rounded-2xl">
                        @endif
                        <div>
                            <input type="file" name="avatar" id="imageInput" style="display: none;">
                        </div>
                        <button id="selectImageButton" title="آپلود پروفایل" class="absolute -right-2 bottom-2   -ml-3  text-white p-1 text-xs bg-blue-600 hover:bg-blue-700 font-medium tracking-wider rounded-full transition ease-in duration-300">
                            <i class="fa fa-edit"></i>
                        </button>
                    </div>
                    <div class="flex-auto sm:ml-5 justify-evenly">
                        <div class="flex items-center justify-between sm:mt-2">
                            <div class="flex items-center">
                                <div class="flex flex-col mr-2">
                                    <div class="w-full flex-none px-3 text-lg dark:text-gray-200 text-gray-800 font-bold leading-none">
                                        {{$user->name??$user->mobile}}
                                    </div>
                                    <div class="flex-auto m-1 dark:text-gray-200 text-gray-800">
                                            <span class="ml-3">
                                                {{$user->mobile}}
                                            </span>
                                        <span class="ml-3 border-r border-gray-600  max-h-0 dark:text-gray-200 text-gray-800"></span><span>{{$user->national_code}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex pt-3 px-2 text-sm text-gray-400">
                            <div class="flex-1 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-blue-600" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                          clip-rule="evenodd">

                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full z-10 rounded-lg" >
        <div class="flex flex-col mx-5 rounded-lg">
            <table class="w-full rounded-lg">
                <tbody class="bg-white rounded-lg divide-y dark:divide-gray-600 dark:bg-gray-700 text-center">
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.description')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{$cost->description}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">جزییات درخواست</td>
                    <td class="px-4 py-3 text-sm">
                        {{$cost->note}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.amount')}}</td>
                    <td class="px-4 py-3 text-sm">
                        {{number_format($cost->amount,0).' تومان '}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">شمار شبا درخواست کننده</td>
                    <td class="px-4 py-3 text-sm">
                        {{$cost->shaba}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">دسته هزینه کرد ها</td>
                    <td class="px-4 py-3 text-sm">
                        {{$cost->category->name}}
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">{{__('dashboard.created_at')}}</td>
                    <td class="px-4 py-3 text-sm">
                        @if(config('app.locale')=='fa')
                            {{verta()->instance($cost->created_at)->format('%d %B %Y')}}
                        @else
                            {{ date('d-M-y', strtotime($cost->created_at))}}
                        @endif
                    </td>
                </tr>
                <tr class="text-gray-700 dark:text-gray-400 w-full mx-auto">
                    <td class="px-4 py-3">دانلود فایل ضمیمه</td>
                    <td class="px-4 py-3 text-sm ">
                        @if($cost->costFile)
                            <div class="w-full p-4">
                                <img src="{{$cost->costFile?route('private.image.show', ['filename' => str_replace('verifies/','',$cost->costFile->path)]):'#'}}" height="200" width="300" alt="" class="rounded shadow-full  @if(!$cost->cost_file_id) hidden @endif ">
                                <br>
                                <a target="_blank" href="{{route('private.image.show', ['filename' => str_replace('verifies/','',$cost->costFile->path)])}}" class="hover:shadow-form rounded-md bg-blue-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                    لینک دانلود
                                </a>
                            </div>
                        @else
                            فایل ضمیمه وجود ندارد
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="w-full mx-auto z-10">
        <div class="flex flex-col">
            <div class="dark:bg-gray-700 border dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                <!-- component -->
                <div class="flex items-center justify-center p-12">
                    <div class="mx-auto w-full">
                        @if(!$cost)
                            <div class="p-4 text-center">
                                <i class="fa-regular fa-credit-card text-red-600 text-6xl px-3"></i>
                            </div>
                            <div class="text-center flex justify-center items-center">
                                <span class="text-2xl text-gray-700 dark:text-gray-200 font-bold">درخواست یافت نشد</span>
                            </div>
                        @elseif($cost->status==='accept')
                            <div class="p-4 text-center">
                                <i class="fa-regular fa-credit-card text-blue-500 text-6xl px-3"></i>
                            </div>
                            <div class="text-center flex justify-center items-center">
                                <span class="text-2xl text-gray-700 dark:text-gray-200 font-bold">
                                    {{$cost->state}}
                                </span>
                            </div>
                            <form id="paymentForm">
                                <input type="hidden" value="{{$cost->id}}" name="id">
                                <button type="submit" class="hover:shadow-form rounded-md bg-blue-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                    لینک پرداخت
                                </button>
                            </form>

                        @elseif($cost->status==='pending')
                            <div class="p-4 text-center">
                                <i class="fa-regular fa-credit-card text-blue-500 text-6xl px-3"></i>
                            </div>
                            <div class="text-center flex justify-center items-center">
                                <span class="text-2xl text-gray-700 dark:text-gray-200 font-bold"> {{$cost->state}}</span>
                            </div>
                        @elseif($cost->status==='cancel')
                            <div class="p-4 text-center">
                                <i class="fa-regular fa-credit-card text-blue-500 text-6xl px-3"></i>
                            </div>
                            <div class="text-center flex justify-center items-center">
                                <span class="text-2xl text-gray-700 dark:text-gray-200 font-bold"> {{$cost->state}} </span>
                            </div>
                        @elseif($cost->status==='fail')
                            <div class="p-4 text-center">
                                <i class="fa-regular fa-credit-card text-blue-500 text-6xl px-3"></i>
                            </div>
                            <div class="text-center flex justify-center items-center">
                                <span class="text-2xl text-gray-700 dark:text-gray-200 font-bold"> {{$cost->state}}</span>
                            </div>
                        @elseif($cost->status==='done')
                            <div class="p-4 text-center">
                                <i class="fa-regular fa-credit-card text-blue-500 text-6xl px-3"></i>
                            </div>
                            <div class="text-center flex justify-center items-center">
                                <span class="text-2xl text-gray-700 dark:text-gray-200 font-bold"> {{$cost->state}}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
