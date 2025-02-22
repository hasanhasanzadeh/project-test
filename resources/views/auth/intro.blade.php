@extends('layouts.app')

@section('content')
    <!-- component -->
    <div class="flex h-screen">
        <!-- Left Pane -->
        <div class="w-full bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 lg:w-1/2 flex items-center justify-center">
            <div class="max-w-md w-full p-6 text-center">
                <div class="block items-center justify-center">
                    <div class="text-sm font-semibold mb-6 text-gray-500 text-center">
                        <a href="{{url('/')}}" class="flex justify-center items-center">
                            <img src="https://flowbite.com/docs/images/logo.svg" alt="{{$title}}" class="h-20 w-20 rounded-full">
                        </a>
                    </div>
                    <h1 class="text-xl font-semibold mb-6 text-black text-center">
                        <a href="{{url('/')}}" class="dark:text-stone-100">
                            {{$title}}
                        </a>
                    </h1>
                </div>
                <div class="space-y-4">
                    <div class="flex">
                        <a href="{{route('register')}}" class="w-full bg-blue-400  dark:bg-blue-500 dark:hover:bg-gray-800 dark:hover:text-white text-dark hover:text-white p-2 rounded-md hover:bg-gray-800 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">
                            ثبت نام
                        </a>
                    </div>
                    <div class="flex">
                        <a href="{{route('login')}}" class="w-full bg-stone-200 text-dark dark:bg-sky-950 dark:hover:bg-gray-800 dark:hover:text-white hover:text-white p-2 rounded-md hover:bg-gray-800 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">
                            ورود
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right Pane -->
        @include('layouts.left')
    </div>
@endsection
