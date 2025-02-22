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
                    <h1 class="text-3xl font-semibold mb-6 text-black text-center">
                        <a href="{{url('/')}}" class="dark:text-stone-100">
                            {{$title}}
                        </a>
                    </h1>
                </div>
                <form action="#" method="POST" class="space-y-4">
                    <!-- Your form elements go here -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Username</label>
                        <input type="text" id="username" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                        <input type="text" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-blue-400 text-dark p-2 dark:text-black rounded-md hover:bg-blue-600 focus:outline-none focus:bg-black focus:text-white focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition-colors duration-300">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Left Pane -->
        @include('layouts.left')
    </div>
@endsection
