@extends('layouts.app')

@section('content')
    <!-- component -->
    <div class="flex h-screen">
        <!-- Right Pane -->
        <div class="w-full bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 lg:w-1/2 flex items-center justify-center">
            <div class="max-w-md w-full p-6">
                <div class="block items-center justify-center">
                    <div class="text-sm font-semibold mb-6 text-gray-500">
                        <a href="{{url('/')}}" class="flex justify-center items-center">
                            <img src="https://flowbite.com/docs/images/logo.svg" alt="{{$title}}" class="h-20 w-20 rounded-full">
                        </a>
                    </div>
                    <h1 class="text-xl font-semibold mb-6 text-black text-center dark:text-stone-100">
                        ورود
                    </h1>
                </div>
                <form action="{{route('login')}}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="mobile" class="block font-medium text-gray-700 dark:text-gray-200 p-1">شماره موبایل</label>
                        <input type="text" id="mobile" name="mobile" class="w-full px-3 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" maxlength="11" required placeholder="شماره موبایل (09xxxxxxxx)">
                    </div>
                    <div x-data="{ show: true }">
                        <label for="password" class="block font-medium text-gray-700 dark:text-gray-200 p-1">کلمه عبور</label>
                        <div class="relative">
                            <input placeholder="کلمه عبور" name="password" :type="show ? 'password' : 'text'" class="w-full px-3 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center text-sm leading-5">
                                <svg class="h-6 text-gray-600 dark:text-stone-200" fill="none" @click="show = !show"
                                     :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                                     viewbox="0 0 576 512">
                                    <path fill="currentColor"
                                          d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                    </path>
                                </svg>
                                <svg class="h-6 text-gray-600 dark:text-stone-200" fill="none" @click="show = !show"
                                     :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                                     viewbox="0 0 640 512">
                                    <path fill="currentColor"
                                          d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded" >
                        </div>
                        <div class="text-sm mr-3">
                            <label for="remember" class="font-medium dark:text-gray-100 text-gray-900">من را به خاطر بسپار</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="flex justify-center text-center items-center px-3 py-2">
                            {!! NoCaptcha::renderJs(app()->getLocale()) !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-blue-500 text-dark p-2 dark:text-black rounded-md hover:bg-blue-600 focus:outline-none focus:bg-black focus:text-white focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-colors duration-300 my-2">ورود</button>
                    </div>
                    <div>
                        <a href="{{route('intro.show')}}" class="block text-center w-full bg-red-500 text-white p-2 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:text-white focus:ring-2 focus:ring-offset-2 focus:ring-red-600 transition-colors duration-300 my-2">انصراف</a>
                    </div>
                    <div>
                        <div class="p-2 text-center">
                            <a href="{{route('password.request')}}" class="dark:text-white hover:text-blue-600 text-dark dark:hover:text-blue-500">
                                کلمه عبورم را فراموش کرده ام!
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Left Pane -->
        @include('layouts.left')
    </div>
@endsection
