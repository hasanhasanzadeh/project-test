<!-- Header -->
<nav class=" fixed left-0 right-0 top-0 z-50">
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap mx-auto max-w-screen-xl p-2 ">
            <div class="w-full flex justify-between p-2">
                <div class="md:text-center">
                    <a href="tel:{{$setting->tel}}" class="dark:text-white sm:text-sm text-stone-700 hover:text-stone-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-1 py-2 mb-2 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa fa-phone"></i>
                        <span>{{$setting->tel}}</span>
                    </a>
                    <a href="mailto:{{$setting->email}}" class="dark:text-white sm:text-sm text-stone-700 hover:text-stone-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-1 py-2 mb-2 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa fa-envelope"></i>
                        <span>{{$setting->email}}</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <nav class="bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="flex justify-start items-center">
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
                <a href="{{url('/')}}" class="flex items-center space-x-3 px-4">
                    <img src="{{$setting->logo->address??asset('images/logo/logo-icon.svg')}}" class="object-cover h-12 w-12  rounded-full" alt="" />
                    <span class="px-3">{{$setting->title}}</span>
                </a>
            </div>
            <div class="flex justify-start items-start ">
                <div class="md:hidden">
                    @if(auth()->check())
                        <a href="{{route('dashboard.user')}}" title="داشبورد" class="text-white bg-blue-600  hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-800 focus:outline-none dark:focus:ring-blue-900">
                            <i class="fa fa-user"></i>
                        </a>
                    @else
                        <a href="{{route('intro.show')}}" title="ورود / ثبت نام" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-800 focus:outline-none dark:focus:ring-blue-900">
                            <i class="fa fa-user"></i>
                        </a>
                    @endif
                </div>
                <div class="hidden w-full md:block md:w-auto">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 mr-9 border border-gray-100 rounded-lg bg-gray-50 md:bg-gray-200 md:flex-row md:space-x-8  md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-800 dark:border-gray-700 items-center justify-center">
                        <li>
                            <a href="{{url('/')}}" class="block py-2 px-3 ml-7 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent md:ml-7">خانه</a>
                        </li>
                        <li>
                            <a href="{{route('about.index')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">درباره ما</a>
                        </li>
                        <li>
                            <a href="{{route('provision.index')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">قوانین</a>
                        </li>
                        <li>
                            <a href="{{route('question.index')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">سوالات متداول</a>
                        </li>
                        <li>
                            <a href="{{route('contact-us.index')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">تماس با ما</a>
                        </li>
                        <li>
                            <a href="{{route('blog.index')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">وبلاگ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden w-full" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 text-center md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:bg-gray-200 md:flex-row md:space-x-8  md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-800 dark:border-gray-700 items-center justify-center">
                    <li class="hover:bg-gray-100">
                        <a href="{{url('/')}}" class="block py-2 px-3 text-gray-900 rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent md:ml-7">خانه</a>
                    </li>
                    <li class="hover:bg-gray-100">
                        <a href="{{route('about.index')}}" class="block py-2 px-3 text-gray-900 rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">درباره ما</a>
                    </li>
                    <li class="hover:bg-gray-100">
                        <a href="{{route('provision.index')}}" class="block py-2 px-3 text-gray-900 rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">قوانین</a>
                    </li>
                    <li class="hover:bg-gray-100">
                        <a href="{{route('question.index')}}" class="block py-2 px-3 text-gray-900 rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">سوالات متداول</a>
                    </li>
                    <li class="hover:bg-gray-100">
                        <a href="{{route('contact-us.index')}}" class="block py-2 px-3 text-gray-900 rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">تماس با ما</a>
                    </li>
                    <li class="hover:bg-gray-100">
                        <a href="{{route('blog.index')}}" class="block py-2 px-3 text-gray-900 rounded md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">وبلاگ</a>
                    </li>
                </ul>
            </div>
            <div class="hidden md:block">
                @if(auth()->check())
                    <a href="{{route('dashboard.user')}}" class="text-white bg-blue-600  hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-800 focus:outline-none dark:focus:ring-blue-900">
                        <i class="fa fa-user"></i>
                        <span class="px-2">داشبورد</span>
                    </a>
                @else
                    <a href="{{route('intro.show')}}" class="text-white bg-blue-600  hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-800 focus:outline-none dark:focus:ring-blue-900">
                        <i class="fa fa-user"></i>
                        <span class="px-2">ورود | ثبت نام</span>
                    </a>
                @endif
            </div>
        </div>
    </nav>
</nav>
