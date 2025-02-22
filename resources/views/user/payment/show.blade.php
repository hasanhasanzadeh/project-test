@extends('user.layouts.app_user')

@section('content')
    <div class="w-full mx-auto z-10">
        <div class="flex flex-col">
            <div class="dark:bg-gray-700 border dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                <div class="flex-none sm:flex gap-4">
                    <div class=" relative h-32 w-32  sm:mb-0 mb-3">
                        @if($user->avatar)
                            <img src="{{$user->avatar->address}}" alt="{{$user->full_name}}" class=" w-32 h-32 object-cover rounded-2xl">
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
                                        {{$user->full_name_with_gender??$user->mobile}}
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
                        <div class="flex flex-row items-center">
                            <div class="flex mr-2">
                                @if($user->userLevel)
                                    @for($i=1,$k=$user->userLevel->level_number;$i <= $user->userLevel->level_number;$i++,$k--)
                                        <i class="fa-solid fa-star text-blue-400 fa-xl py-2 px-1"></i>
                                    @endfor
                                    @for(;$k > 0;$k--)
                                        <i class="fa-regular fa-star text-blue-400 fa-xl py-2 px-1"></i>
                                    @endfor
                                @else
                                    @for($j=1;$j <= 6;$j++)
                                        <i class="fa-regular fa-star text-blue-400 fa-xl py-2 px-1"></i>
                                    @endfor
                                @endif
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
                                <p class="px-2 dark:text-gray-200 text-gray-800">{{$user->userLevel->level_name??'سطح صفر'}}</p>
                            </div>
                            <a href="{{route('level.show')}}"  class="flex-no-shrink bg-green-600 hover:bg-green-700 px-5 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-500 hover:border-green-500 text-white rounded-full transition ease-in duration-300">
                                ارتقاء سطح کاربری
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mx-auto z-10">
        <div class="flex flex-col">
            <div class="dark:bg-gray-700 border dark:border-gray-900 shadow-lg  rounded-3xl p-4 m-4">
                <!-- component -->
                <div class="flex items-center justify-center p-12">
                    <div class="mx-auto w-full">
                        @if(!$payment || $payment->status!='completed')
                            <div class="p-4 text-center">
                                <i class="fa-regular fa-credit-card text-red-600 text-6xl px-3"></i>
                            </div>
                            <div class="text-center flex justify-center items-center">
                                <span class="text-2xl text-gray-700 dark:text-gray-200 font-bold">پرداخت ناموفق</span>
                            </div>
                        @elseif($payment->status==='completed')
                            <div class="p-4 text-center">
                                <i class="fa-regular fa-credit-card text-blue-500 text-6xl px-3"></i>
                            </div>
                            <div class="text-center flex justify-center items-center">
                                <span class="text-2xl text-gray-700 dark:text-gray-200 font-bold">کیف پول شما با موفقیت شارژ شد</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
